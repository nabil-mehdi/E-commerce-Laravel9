<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\ProduitCommande;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Symfony\Component\Console\Input\Input;
use Dompdf\Options;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use App\Jobs\GeneratePdfJob;
use Swift_Attachment;

use function Laravel\Prompts\alert;

class ControllerCommande extends Controller
{

    public function Affichercmd()
    {
        $commande = Commande::all();
        return view('commandes.commande', compact('commande'));
    }

    public function Afficherdetailcmd(Request $request)
    {
        $idCommande = $request->id;

        // Recherche des détails de la commande dans la table ProduitCommande en utilisant l'attribut idCommande

        $details = ProduitCommande::where('idCommande', $idCommande)->get();
        return view('commandes.detailcommande', compact('details'));
    }

    public function mettreaupannier(Request $request)
    {
        // Récupérer les données du formulaire
        $id = $request->input('id');
        $qte = $request->input('qte');
        $stock = $request->input('stock');
        $prix = $request->input('prix');
        $nom = $request->input('nom');


        // Utiliser la session pour stocker les informations
        $cart = session()->get('cart', []);

        $existingProductIndex = -1;
        foreach ($cart as $index => $item) {
            if ($item['id'] == $id) {
                $existingProductIndex = $index;
                break;
            }
        }
        if ($qte > $stock) {
            return redirect()->back()->with('alert', 'Rupture de stock');
        }
        if ($existingProductIndex !== -1) {
            $cart[$existingProductIndex]['qte'] += $qte;
        } else {
            $cart[] = [
                'id' => $id,
                'nom' => $nom,
                'qte' => $qte,
                'prix' => $prix
            ];
        }




        // Mettre à jour la session avec le nouveau panier
        session()->put('cart', $cart);
        return redirect()->route('indexprod');
    }

    public function Afficherpanier()
    {
        // Récupérer les produits dans le panier depuis la session
        $cart = session()->get('cart', []);

        // Calculer le total du panier
        $total = $this->total();


        // Retourner la vue 'panier' en passant les données nécessaires
        return view("Panier.index", compact('cart', 'total'));
    }
    public function total()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            // Use a different variable name in the foreach loop to avoid overwriting $cart
            $total += $item['prix'] * $item['qte'];
        }
        return $total;
    }

    public function clearCart()
    {

        Session::forget('cart');

        return redirect()->route('indexprod');
    }
    public function validercommande(Request $request)
    {
        $commande = new Commande();
        $commande->datecde = date('d/m/y');
        $commande->total = $this->total();
        $commande->save();

        $cart = json_decode($request->input('cart'), true);

        foreach ($cart as $item) {
            $produitcmd = new ProduitCommande();
            $produitcmd->idProduit = $item['id'];
            $produitcmd->idCommande = $commande->id;
            $produitcmd->qte = $item['qte'];
            $produitcmd->save();
            $produit = Produit::find($item['id']); // Supposons que votre modèle de produit s'appelle Produit
            $produit->qte -= $item['qte']; // Déduire la quantité commandée de la quantité en stock
            $produit->save();
        }
        $tocken = uniqid();
        $this->EnregisterPdf($tocken);
        $this->mail($tocken);
        $this->clearCart();
        return redirect()->route('indexprod');
    }

    public function pdfFromView()
    {
        if (session()->get("cart") != null)
            $pannier = session()->get("cart");
        $amount = $this->total();
        $file = FacadePdf::loadView('Panier.pdf', ['pannier' => $pannier, 'amount' => $amount]);
        return $file->stream();

        return redirect()->route('Produit.index');
    }


    public function Remplirfacture(Request $request)
    {
        // Récupérer l'id de la commande à partir de la requête
        $idCommande = $request->input('idcommande');

        // Récupérer les détails de la commande spécifiée depuis la base de données
        $details = ProduitCommande::where('idCommande', $idCommande)->get();

        // Passer les détails à la vue 'commandes.Facture' et générer le contenu HTML
        $html = view('commandes.Facture', compact('details'))->render();

        // Créer une instance de Dompdf
        $pdf = new Dompdf();

        // Charger le contenu HTML dans Dompdf
        $pdf->loadHtml($html);

        // Définir le format du papier et l'orientation
        $pdf->setPaper('A4', 'landscape');

        // Générer le PDF
        $pdf->render();



        // Télécharger ou afficher le PDF généré
        return $pdf->stream("Facture.pdf");
    }
    public function EnregisterPdf($tocken)
    {
        if (session()->get("cart") != null) $pannier = session()->get("cart");
        else $pannier = array();
        $amount = $this->total();
        //  $qrcode = QrCode::size(200)->generate($tocken, "QRCode/".$tocken.".svg");
        $file = FacadePdf::loadView('Panier.pdf', ['pannier' => $pannier, 'amount' => $amount, 'qrcode' => $tocken]);
        $file->stream();
        $file->save('facture/' . $tocken . '.pdf');
    }
    public function mail($tocken)
    {

        // $transport = (new Swift_SmtpTransport('smtp.gmail.com',  465, "ssl"))
        $transport = new \Swift_SmtpTransport('smtp.gmail.com',  465, "ssl");
        $transport->setUsername('Mehdina.pro@gmail.com');
        $transport->setPassword('yorsvqdlzjhntesz');

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Facture'))
            ->setFrom(['Mehdina.pro@gmail.com' => 'Mehdi Nabil'])
            ->setTo(['n.hamrkmeja@attijariwafa.com'])
            ->setBody('Here is the message itself');

        $message->attach(Swift_Attachment::fromPath(public_path('facture/' . $tocken . '.pdf')));
        // Send the message
        $result = $mailer->send($message);
    }
}
