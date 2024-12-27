<html>
    <img src="C:\Users\User\Pictures\scan\banane" alt="">

       <h2>Facture </h2>
        <table border='1' align='center'>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
        </tr>

        @foreach ($details as $item)
        <tr>
            <td>{{$item->produit->designation}}</td>
            <td>{{$item->qte}}</td>
            <td>{{$item->produit->prix}}</td>
          
        </tr>
        @endforeach
        <div class='foot'>
            <div class='total'>Total: {{$item->commande->total}} </div>  
        </div>
      
        </html>