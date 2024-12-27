<html>
<form action="{{ route('updateprod',['id'=>$produit->id]) }}" method="post">
    @csrf
    <table border="1" align="center">
    <tr><th colspan="2">Modification du Produit</th></tr>
    <tr><td>Numéro </td><td><input type="hidden" name="id" value="{{$produit->id}}">{{$produit->id}}</td></tr>
    <tr><td>Désignation </td><td><input type="text" name="designation" value="{{$produit->designation}}"></td></tr>
    <tr><td>Description </td><td><textarea name="description">{{ $produit->description }}</textarea></td></tr>
    <tr><td>Prix </td><td><input type="number" name="prix" value="{{$produit->prix}}"></td></tr>
    <tr><td>stock </td><td><input type="number" name="stock" value="{{$produit->qte}}"></td></tr>
    <tr><td>Date de Production </td><td><input type="datetime-local" name="dateprod" value="{{$produit->dateProduction}}"></td></tr>
    <tr><td>Catégorie </td><td>
    <select name="cat">
        @foreach($categories as $cat)
        @if($cat->id == $produit->categorie->id)
        <option value="{{$cat->id}}" selected>{{$cat->designation}}</option>
        @else
        <option value="{{$cat->id}}">{{$cat->designation}}</option>
        @endif
        @endforeach
    </select>
    </td></tr>
    <tr align="center"><td><input type="submit" value="Valider"></td><td><input type="reset" value="Annuler"></td></tr>
    </table>
</form>
</html>
