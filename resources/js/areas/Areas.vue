<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Áreas</h3>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal">
                Agregar <i class="fas fa-plus-circle fa-fw"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Acrónimo</th>
                  <th>Fecha Registro</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="area in areas" :key="area.id">
                  <td>{{ area.id }}</td>
                  <td>{{ area.name }}</td>
                  <td>{{ area.acronym }}</td>
                  <td>{{ area.created_at }}</td>
                  <td>
                    <a title="Editar" href="#">
                      <i class="fa fa-edit blue" @click="editArea(area)"></i>
                    </a>
                    /
                    <a title="Eliminar" href="#">
                      <i
                        class="fa fa-trash red"
                        @click="deleteArea(area.id)"
                      ></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer"></div>
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
            <h5 class="modal-title" v-show="!editmode" id="addNewLabel">
              Agregar Área
            </h5>
            <h5 class="modal-title" v-show="editmode" id="addNewLabel">
              Editar Área
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            @submit.prevent="editmode ? updateArea() : agregarArea()"
            id="principal"
          >
            <div class="modal-body">
              <div class="form-group">
                <label> <span class="label-text">Nombre:</span></label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  placeholder="Ingresa un Nombre"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <label> <span class="label-text">Acrónimo:</span></label>
                <input
                  v-model="form.acronym"
                  type="text"
                  name="acronym"
                  placeholder="Ingresa un Acrónimo"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('acronym') }"
                />
                <has-error :form="form" field="acronym"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Cerrar
              </button>
              <button v-show="editmode" type="submit" class="btn btn-success">
                Actualizar
              </button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">
                Guardar
              </button>
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
      areas: {},
      form: new Form({
        id: "",
        name: "",
        acronym: "",
      }),
    };
  },
  methods: {
    newModal() {
      this.editmode = false;
      $("#principal").find(".is-invalid").removeClass("is-invalid");
      this.form.reset();
      $("#addNew").modal("show");
    },
    editArea(area) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(area);
      this.form.errors.clear();
    },
    loadAreas() {
      axios.get("api/areas").then(({ data }) => (this.areas = data));
    },
    agregarArea() {
      this.$Progress.start();
      this.form
        .post("api/areas")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Área creada correctamente",
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateArea() {
      this.$Progress.start();
      this.form
        .put("api/areas/" + this.form.id)
        .then(() => {
          // success
          $("#addNew").modal("hide");
          Swal.fire(
            "Actualizado!",
            "El elemento ha sido actualizado",
            "success"
          );
          this.$Progress.finish();
          Fire.$emit("AfterCreate");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deleteArea(id) {
      Swal.fire({
        title: "Estas Seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, elimínalo!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.value) {
          this.form
            .delete("api/areas/" + id)
            .then(() => {
              Swal.fire(
                "Eliminado!",
                "El elemento ha sido eliminado",
                "success"
              );
              Fire.$emit("AfterCreate");
            })
            .catch(() => {
              Swal("Fallido!", "Algo salió mal.", "warning");
              this.$Progress.fail();
            });
        }
      });
    },
  },
  created() {
    this.loadAreas();
    Fire.$on("AfterCreate", () => {
      this.loadAreas();
    });
    //setInterval(() => this.cargarAreas(), 3000);
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
