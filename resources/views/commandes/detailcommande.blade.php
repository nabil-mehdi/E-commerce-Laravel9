<html>
    <x-Master title="Fiche du Produit">
        <div class="cont">
<h2> Fiche du Produit</h2>
</div>
   <table>
        <thead>
            <tr>
               
                <th>Produit </th>
                <th>Quantite</th>
           
               
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $item)
                <tr>
                   
                  
                    <td>{{$item->produit->designation}}</td>
                    <td>{{$item->qte}}</td>
               
                        
                
                  
                </tr>

                @endforeach
               
        </tbody>
        
        
    </table>
Total: {{$item->commande->total}}DH
<a href="{{route('indexprod')}}">Retour</a>
<form action="{{ route('Remplirfacture', ['idCommande' => $details->first()->idCommande]) }}" method="post">
    @csrf
    <input type="hidden" name="idcommande" value="{{$details->first()->idCommande}}" >
<input type="submit"  value="Imprimer" >

</form>

</html>
<a id="link-pdf" href="">
    <img src="{{ asset('images/pdf.png') }}" alt="PDF" width="30" height="30">
</a>
</x-Master>