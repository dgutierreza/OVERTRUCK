<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-3">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Usuarios</h3>

            <div class="card-tools">
              <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addNew"
              >
                Agregar Usuario <i class="fas fa-user-plus"></i>
              </button>
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
                  <td>
                    <a title="Editar" href="#">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    /
                    <a title="Eliminar" href="#">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
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
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">Agregar Usuario</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createUser()">
            <div class="modal-body">
              <div class="form-group">
                <label> <span class="label-text">DNI:</span></label>
                <input
                  type="text"
                  name="dni"
                  @keyup.enter="searchDni"
                  v-model="dni"
                  placeholder="Ingresa su DNI"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('dni') }"
                />
                <has-error :form="form" field="dni"></has-error>
              </div>
              <!-----FORMULARIO----->

              <div class="form-group">
                <label> <span class="label-text">Primer Nombre:</span></label>
                <input
                  type="text"
                  name="first_name"
                  v-model="form.first_name"
                  placeholder="..."
                  class="form-control"
                  disabled
                />
              </div>
              <div class="form-group">
                <label> <span class="label-text">Segundo Nombre:</span></label>
                <input
                  type="text"
                  name="second_name"
                  v-model="form.second_name"
                  placeholder="..."
                  class="form-control"
                  disabled
                />
              </div>
              <div class="form-group">
                <label>
                  <span class="label-text">Apellido Paterno:</span></label
                >
                <input
                  type="text"
                  name="first_last_name"
                  v-model="form.first_last_name"
                  placeholder="..."
                  class="form-control"
                  disabled
                />
              </div>
              <div class="form-group">
                <label>
                  <span class="label-text">Apellido Materno:</span></label
                >
                <input
                  type="text"
                  name="second_last_name"
                  v-model="form.second_last_name"
                  placeholder="..."
                  class="form-control"
                  disabled
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Cerrar
              </button>
              <button type="button" class="btn btn-primary">Guardar</button>
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
      dni: "",
      form: new Form({
        id: "",
        first_name: "",
        second_name: "",
        first_last_name: "",
        second_last_name: "",
        dni: "",
      }),
    };
  },
  methods: {
    searchDni() {
      axios
        .get("api/search-dni/" + this.dni)
        .then(({ data }) => {
          console.log(data);
          var names = data.nombres.toLowerCase().split(" ", 3);
          var first_last_name = data.apellidoPaterno.toLowerCase();
          var second_last_name = data.apellidoMaterno.toLowerCase();
          if(names.length == 3){
                var first_name  = names[0];  
                var second_name  = names[1];
                var third_name  = names[2];
                var seconds_name = second_name+' '+third_name; 
                }
          if(names.length == 2){
                var first_name  = names[0];  
                var seconds_name  = names[1];
                }
          if(names.length == 1){
                var first_name  = names[0];  
                var seconds_name  = '';
                }
               
                this.form.first_name = first_name;
                this.form.second_name = seconds_name;
                this.form.first_last_name = first_last_name;
                this.form.second_last_name = second_last_name;
                this.form.dni = data.dni;
                
        })
        
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
