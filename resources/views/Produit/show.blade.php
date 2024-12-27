<html>
    <x-Master title="Fiche du Produit">
        <div class="cont">
<h2> Fiche du Produit</h2>
</div>
   <table>
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Description </th>
                <th>Prix unitaire</th>
                <th>Date de Production </th>
                <th>categorie</th>
            </tr>
        </thead>
        <tbody>
           
                <tr>
                    <td>{{$produits->designation}}</td>
                    <td>{{$produits->description}}</td>
                    <td>{{$produits->prix}}</td>
                    <td>{{$produits->dateProduction}}</td>
                    <td>{{$produits->categorie->designation}}</td>
                </tr>
     
        </tbody>
        
        
    </table>


</html>
<a href="{{route('indexprod')}}">Retour</a>
</x-Master>