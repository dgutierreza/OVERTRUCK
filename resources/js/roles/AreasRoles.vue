<template>
    <div class="container">
      <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Roles</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Agregar <i class="fas fa-plus-circle fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Área</th>
                      <th>Fecha Registro</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="area_rol in area_roles" :key="area_rol.id">
                      <td>{{area_rol.id}}</td>
                      <td>{{area_rol.name}}</td>
                      <td hidden>{{area_rol.id_area}}</td>
                      <td>{{area_rol.area}}</td>
                      <td>{{area_rol.created_at}}</td>
                      <td>
                        <a title="Editar" href="#" >
                            <i class="fa fa-edit blue" @click="editAreaRol(area_rol)"></i>
                        </a>
                        /
                        <a title="Eliminar" href="#" >
                            <i class="fa fa-trash red" @click="deleteAreaRol(area_rol.id)"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  
              </div>
            </div>
            <!-- /.card -->
          </div>
    </div>
    <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Agregar Rol Area</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Editar Rol Area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateAreaRol() :addAreaRol()" id="principal">
                <div class="modal-body">
                    <div class="form-group">
                      <label> <span class="label-text">Nombre:</span></label>
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Ingresa un Nombre"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div v-show="!editmode" class="form-group">
                      <label> <span class="label-text">Área:</span></label>
                      <select class="form-control" v-model="form.area" name="area" :class="{ 'is-invalid': form.errors.has('area')}">
                        <option v-for="area in areas" :key="area.id" v-bind:value="area.id" v-text="area.name"></option>                        
                      </select>
                        <has-error :form="form" field="area"></has-error>
                    </div>
                    <div v-show="editmode" class="form-group">
                      <label> <span class="label-text">Área:</span></label>
                      <select class="form-control" name="area" v-model="form.id_area" :class="{ 'is-invalid': form.errors.has('id_area')}">
                       <option v-for="area in areas" :key="area.id" v-bind:value="area.id" v-text="area.name" :selected="form.area==area.nombre"></option>                        
                      </select>
                      
                        <has-error :form="form" field="id_area"></has-error>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Actualizar</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
                </div>
            </div>
            </div>
</div>
</template>
<script>
    export default {
      data() {
            return {
                editmode: false,
                area_roles: {},
                areas: [],
                form: new Form({
                    id: '',
                    name : '',
                    area: null,
                    id_area: '',
                })
            }
        },
        methods: {
          loadAreas()
          {
             axios.get('api/select-areas').then(response => {this.areas = response.data.areas;});
          },
          loadAreaRoles(){
               axios.get("api/areas_roles").then(({ data }) => (this.area_roles = data));
          },
          newModal(){
                this.editmode = false;
                $("#principal").find('.is-invalid').removeClass("is-invalid");
                this.form.reset();
                $('#addNew').modal('show');
            },
          addAreaRol(){
            this.$Progress.start();
            this.form.post('api/areas_roles')
            .then(()=>{
            Fire.$emit('AfterCreate');
            $('#addNew').modal('hide')
            Toast.fire({
            icon: 'success',
            title: 'Area Rol creado correctamente'
                      })
            this.$Progress.finish();
            })
              .catch(()=>{
                this.$Progress.fail();
              })
          },
          editAreaRol(area_rol){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(area_rol);
                this.form.errors.clear();
            },
          updateAreaRol(){
              this.$Progress.start();
              this.form.put('api/areas_roles/'+this.form.id)
              .then(() => {
                    // success
                    $('#addNew').modal('hide');
                    Swal.fire('Actualizado!','El elemento ha sido actualizado','success')
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            deleteAreaRol(id){
                Swal.fire({
            title: 'Estas Seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, elimínalo!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {
          this.form.delete('api/areas_roles/'+id).then(()=> {
                Swal.fire('Eliminado!','El elemento ha sido eliminado','success')
                Fire.$emit('AfterCreate');
              }).catch(()=> {
              Swal("Fallido!", "Algo salió mal.", "warning");
                            });
                this.$Progress.fail();
                  }
            }) 
            },
        },  
        created(){
          this.loadAreas();
          this.loadAreaRoles();
          Fire.$on('AfterCreate',() => {
               this.loadAreaRoles();
           });
          //setInterval(() => this.cargarAreas(), 3000);
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>