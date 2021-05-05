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
                        <tr v-for="(user, index) in users" :key="index">
                        <td>{{index + 1}}</td>
                        <td>
                            {{ `${user.first_name} ${user.second_name} ${user.first_last_name} ${user.second_last_name}` }}
                            </td>
                        <td>{{user.dni}}</td>
                        <td>
                            <a title="Editar" href="#" >
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

            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li
                        v-for="(page, index) in meta.pages"
                        :key="index"
                        class="page-item"
                        v-bind:class="page == meta.current_page ? `active` : ``"
                        v-bind:aria-current="page == meta.current_page ? `page` : ``">
                        <a class="page-link" href="#">{{page}}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
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
    import {mapGetters} from 'vuex';

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
        computed:{
            ...mapGetters([
                'users',
                'links',
                'meta'
            ])
        },
        mounted() {
            console.log('Component mounted.')
        },
        async created() {
            await this.$store.dispatch('getAllUsers');
            console.log(this.meta);
        },
        methods: {

        }
    }
</script>
