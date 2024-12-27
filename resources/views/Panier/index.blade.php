<x-Master title="Panier">
    <div class="tete">
    <h2>Panier</h2>
</div>

    <div class="panier-content">
        @if (empty($cart))
            <p>Votre panier est vide.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                        <tr>
                            <td>{{ $item['nom'] }}</td>
                            <td>{{ $item['prix'] }}</td>
                            <td>{{ $item['qte'] }}</td>
                            <td>{{ $item['qte'] * $item['prix'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                
                
            </table>
            <!-- Afficher le total du panier -->
            <p>Total : {{ $total }}</p>
            <Div class="btnpanier">
            <form action="{{ route('clearCart') }}" method="POST">
                @csrf
                <input type="submit" value="Vider le panier">
              
             
            </form>
         
            
            <form id="form-pdf-valider" action="{{ route('validercommande') }}" method="POST">
                @csrf
                <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
                <input type="submit" value="Valider le panier">
            </form>
            
            

            <a href="{{ route('pdfFromView') }}"">pdf</a>

        </Div>
        @endif
      
    </div>
   
</x-Master>
