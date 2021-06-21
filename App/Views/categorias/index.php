
<div class="categorias-container">
    <div style="display:flex; align-items: center; justify-content: center; margin-bottom: 20px">
        <h1 style="margin: 0">Lista de Categorias</h1>
        <button id="addCategoria" style="width: fit-content; align-self: center; border-radius: 50%; margin-left: 10px;">+</button>
    </div>
    <!--Percorrer os resultados da consulta-->
    <?php
    //Se o número de resultados de linhas for igual a zero, então exibe o erro: "Nenhuma categoria cadastrada"
        if(count($data) == 0){
            echo "<p style='text-align: center'>Nenhuma categoria cadastrada</p>";
        }
        //Listagem: 
        foreach($data as $categoria){
    ?>
        <div class="card-categorias">
            <!-- Categoria agora é um objeto, então usamos-o dessa forma:  -->
            <?=$categoria->descricao?>
            <img onclick="editarCategoria(<?= $categoria->id?>)" src="/imgs/edit.svg"/>    
            <img onclick="deletarCategoria(<?= $categoria->id?>)" src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png"/>
                
        </div>
    <?php
        }
    ?>
    <script>
        function deletarCategoria(categoriaId){
            if(confirm("Deseja realmente deletar essa categoria?")){
                window.location = `/categorias/destroy/${categoriaId}`;
            }
        }

        function editarCategoria(categoriaId){
            window.location = `/categorias/edit/${categoriaId}`;
        }
        
        document.querySelector('#addCategoria').addEventListener('click', ()=>{
            window.location = "/categorias/create";
        } );


    </script>
</div>