@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Pedido</h3>

        @include('errors._check')

        <div class="container">
            {!! Form::open(['route' => 'customer.order.store', 'class' => 'form']) !!}

            <div class="form-group">
                <p>Me desculpe mas no meu computador não está ocorrendo o erro reportado. Fiz uma alteração para quando
                o total for null passar o valor 0 antes de totalizar, acho que isso deve resolver, mas comigo não ocorre o erro.</p>
                <br>
                <p>Assista ao vídeo que está na pasta public\vídeo</p>
                <br>


                <label>Total: </label>
                <p id="total"></p>
                <a href="#" id="btnNewItem" class="btn btn-default">Novo Item</a>

                <table class="table table-border">
                    <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <select class="form-control" name="items[0][product_id]">
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" data-price="{{ $p->price }}">
                                        {{ $p->name }} -- {{ $p->price }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {!! Form::text('items[0][qtd]',1,['class' => 'form-control']) !!}
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    {!!  Form::submit('Criar Pedido',['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('post-script')
    <script>
        $('#btnNewItem').click(function() {
            var row = $('table tbody > tr:last'),
                    newRow = row.clone(),
                    length = $('table tbody tr').length;
            newRow.find('td').each(function(){
                var td = $(this),
                        input = td.find('input,select'),
                        name = input.attr('name');

                input.attr('name',name.replace((length -1) + "", length + ""))
            });

            newRow.find('input').val(1);
            newRow.insertAfter(row);
            calculateTotal();
        });

        $(document.body).on('click','select',function() {
            calculateTotal();
        });

        $(document.body).on('blur','input',function() {
            calculateTotal();
        });

        window.onload = function(){
            calculateTotal();
        }

        function calculateTotal() {
            var total = 0,
                    trLen = $('table tbody tr').length,
                    tr = null, price, qtd;

            for (var i = 0 ; i < trLen ; i++){
                tr = $('table tbody tr').eq(i);
                price = tr.find(':selected').data('price');
                qtd = tr.find('input').val();
                total += price * qtd;
            }
            $('#total').html(total);
        }
    </script>
@endsection