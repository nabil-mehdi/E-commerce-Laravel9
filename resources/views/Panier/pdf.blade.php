<html>

<h3>Facture</h3>
<pre style="color: red"> Cette facture provisoire</pre>
  <table border="1" align="center">
  <tr>
    <th>Nom du Produit</th>
    <th>Quantité</th>
    <th>Prix Unitaire</th>
</tr>

@forelse ($pannier as $lignecommande)
  <tr>
        
        <td>{{$lignecommande['nom']}}</td>
        <td>{{$lignecommande['qte']}}</td>
    <td>{{$lignecommande['prix']}}</td>
    </tr>
@empty 
Pannier Vide
@endforelse
  <tr><th>Nombre de Produits</th><th>{{ count($pannier) }}</th>
  <th>{{ $amount}} MAD</th>
  </tr>
  </table>

 
</html>