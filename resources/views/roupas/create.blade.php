@extends('layouts.main')

@section('title', 'Cadastrar Roupa')

@section('content')
    <div class="container">

        <div class="container col-sm-5">

            <h1>Cadastro de roupa</h1>
            <hr>
            <form action="/roupas" method="POST" enctype="multipart/form-data" class="form-inline">
                @csrf
                <form-group>
                    <label for="image">Foto da roupa:</label>
                    <input type="file" class="form-control-file" id="image" name="image"
                        placeholder="Imagem da roupa" onchange="loadFile(event)">
                        <hr>
                        <img id="preview" src="" style="width: 350px">
                </form-group><br>


                <form-group>
                    <label for="tipo">Tipo:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo da Roupa">
                </form-group>

                <form-group>
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca da Roupa">
                </form-group>

                <form-group>
                    <label for="preco">Preço:</label>
                    <input type="number" class="form-control" id="preco" name="preco" placeholder="Preço da Roupa"
                        step="0.01">
                </form-group>

                <form-group>
                
                    <label for="check">Selecione os tamanhos disponíveis:</label>
                    <div class="form-group">
                        <input type="checkbox" name="tamanhos[]" value="XS"> XS (EUA) - PP (BR)
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="tamanhos[]" value="S"> S (EUA) - P (BR)
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="tamanhos[]" value="M"> M (EUA-BR)
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="tamanhos[]" value="L"> L (EUA) - G (BR)
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="tamanhos[]" value="XL"> XL (EUA) - GG (BR)
                    </div>
                </form-group>

                <form-group style="margin: 170px">
                    <input type="reset" class="btn btn-outline-primary" value="Limpar">
                    <input type="submit" class="btn btn-outline-success" value="Cadastrar">
                </form-group>

            </form>

        </div>
    </div>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
