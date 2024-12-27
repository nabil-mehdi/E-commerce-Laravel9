<x-Master title="Liste Produit">
  
   <div class="tete">
<h2>Liste Produit</h2>

<a  class="Panier"  href="{{ route('Panier') }}">
    <img src="{{ asset('images/panier.png') }}" alt="Panier" width="30" height="30">
    <div class="nbprd">{{count($pannier)}}</div>
   </a>
  

</div> 
@include('produit.find')


    <div class="general">
        <div class="container">
            <div class="cart-icon">
               
            </div>
            <div class="tab">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Designation</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Prix</th>
                            <th>Date</th>
                            <th>Categorie</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produits as $prod)
                        <tr>
                            <td>{{$prod->id}}</td>
                            <td>{{$prod->designation}}</td>
                            <td>{{$prod->description}}</td>
                            <td><input class="stock" type="text" value="{{$prod->qte}}" readonly></td>
                            <td>{{$prod->prix}}</td>
                            <td>{{$prod->dateProduction}}</td>
                            <td>{{$prod->categorie->designation}}</td>
                            <td>
                                <form name="panier" action="{{ route('mettreaupannier') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="nom" value="{{ $prod->designation }}">
                                    <input type="hidden" name="prix" value="{{ $prod->prix }}">
                                    <input type="hidden" name="stock" value="{{$prod->qte}}">
                                    <input type="hidden" name="id" value="{{ $prod->id }}" >
                                    <input id="qte"  type="number" name="qte"min="0" value="1">
                                    @if ($prod->qte == 0)
                                    <input class="stockindis" value="Rupture" disabled>
                                     @else
                                     <input id="ajoutpanier" type="submit" value="Add">
                                    @endif
                                </form>
                                
                        
                                </td>
                                
                        
                        <td><a href="{{route('showprod',['id'=>$prod->id])}}">
                            <img src="{{asset('images/show.png')}}" width=30 height=30/></a></td>
                        <td><a href="{{route('delprod' ,['id'=>$prod->id])}}" onclick="return confirm('Confirmation ?')"><img src="{{asset('images/delete.jpg')}}" width=30 height=30/></a></td>
                        <td><a href="{{route('editprod' ,['id'=>$prod->id])}}"><img src="{{asset('images/edit.jpg')}}" width=30 height=30/></a></td>
                        </tr>
                      
                    </tbody>


@empty 
Aucun Produit
@endforelse
    <tr><th colspan=6>Nombre de Produits</th><th colspan=5>{{ count($produits) }}</th></tr>
</table>
<div class="btaj">
<div class="btn">
    <a class="aj" href="{{route('formprod')}}">Ajouter Produit</a>

</div>
<div class="btn">
    <a class="aj ajca" href="{{route('formcat')}}">Ajouter Categorie</a>

</div>
<div class="btn">
    <a class="aj ajca" href="{{route('Affichercmd')}}">Afficher Commande</a>

</div>
</div>
</div>



</x-Master>