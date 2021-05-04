<template>
    <div class="container">
        
        <div class="row">
          <div class="col-md-12 mt-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Usuarios</h3>

                <div class="card-tools">
                  <button class="btn btn-success" data-toggle="modal" data-target="#addNew">Agregar Usuario <i class="fas fa-user-plus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre Compl.</th>
                      <th>DNI</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><a title="Editar" href="#" >
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a title="Eliminar" href="#">
                            <i class="fa fa-trash red"></i>
                        </a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

       <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
            </div>
        </div>
        </div>
 
    </div>
    
</template>

<script>
    export default {
        data(){
            return{
                dni:'',
                form: new Form({
                    id: '',
                    first_name : '',
                    second_name: '',
                    first_last_name: '',
                    second_last_name: '',
                    dni: '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
