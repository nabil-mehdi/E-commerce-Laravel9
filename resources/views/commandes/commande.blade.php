<x-Master title="Commande">
    <h2>Commande</h2>

    <div class="general">
        <div class="container">
            <div class="cart-icon">
                <div class="tab">
                    <table>
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Afficher detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($commande as $prod)
                            <tr>
                                <td>{{$prod->id}}</td>
                                <td>{{$prod->total}}</td>
                                <td>{{$prod->datecde}}</td>
                                <td>
                                <a class="btn btncmd" href="{{route('Afficherdetailcmd',['id'=>$prod->id])}}" >Clic ici</a>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">Aucun Produit</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- Fin de la div .tab -->
            </div> <!-- Fin de la div .cart-icon -->
        </div> <!-- Fin de la div .container -->
    </div> <!-- Fin de la div .general -->
</x-Master>
