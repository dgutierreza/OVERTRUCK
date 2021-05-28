<template>
  <div class="tab-pane active" id="personal">
    <strong><i class="fas fa-user-edit"></i> Sexo:</strong>
    {{ this.$parent.userDetail.sex }} <br />
    <strong><i class="fas fa-user-edit"></i> Estado Civil:</strong>
    {{ this.$parent.userDetail.est_civ }} <br />
    <strong><i class="fas fa-child"></i> Num. Hijos:</strong>
    {{ this.$parent.userDetail.num_childs }} <br />
    <strong><i class="fas fa-birthday-cake"></i> Fecha Nacimiento:</strong>
    {{ this.$parent.userDetail.date_btd }}<br />
    <strong><i class="fas fa-envelope"></i> Correo Empresa:</strong>
    {{ this.$parent.userDetail.email }} <br />
    <strong><i class="fas fa-envelope"></i> Correo Personal:</strong>
    {{ this.$parent.userDetail.email_personal }} <br />
    <strong><i class="fas fa-phone"></i> Celular Principal:</strong>
    {{ this.$parent.userDetail.celphone_pri }} <br />
    <strong><i class="fas fa-phone"></i> Celular Secundario:</strong>
    {{ this.$parent.userDetail.celphone_sec }} <br />
    <strong><i class="fas fa-phone"></i> Celular Trabajo:</strong>
    {{ this.$parent.userDetail.celphone_job }} <br />
    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección Casa:</strong
    >{{ this.$parent.userDetail.adress_home }}<br />
    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección Dni:</strong>
    {{ this.$parent.userDetail.adress_dni }}<br />

    <button
      class="btn btn-primary float-sm-right"
      @click="notEmptyObject() ? editModal() : newModal()"
    >
      Editar Datos <i class="fas fa-user-edit"></i>
    </button>

    <!-- /.MODAL -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
      style="z-index: 1100 !important"
    >
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewLabel">
              <strong></strong> {{ this.$parent.user.name_complete }}
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
            @submit.prevent="
              notEmptyObject() ? updateUserDetail() : createUserDetail()
            "
            id="principal"
          >
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label> <span class="label-text">Sexo:</span></label>
                    <select
                      class="form-control"
                      name="sex"
                      v-model="formedit.sex"
                      :class="{ 'is-invalid': formedit.errors.has('sex') }"
                    >
                      <option
                        v-for="sex in sexs"
                        :key="sex.id"
                        v-bind:value="sex.id"
                        v-text="sex.name"
                        :selected="formedit.sex == null"
                      ></option>
                    </select>
                    <has-error :form="formedit" field="sex"></has-error>
                  </div>

                  <div class="form-group">
                    <label>
                      <span class="label-text">Estado Civil:</span></label
                    >
                    <select
                      class="form-control"
                      name="est_civ"
                      v-model="formedit.est_civ"
                      :class="{
                        'is-invalid': formedit.errors.has('est_civ'),
                      }"
                    >
                      <option
                        v-for="status in status_civil"
                        :key="status.id"
                        v-bind:value="status.id"
                        v-text="status.name"
                        :selected="formedit.status_civ == null"
                      ></option>
                    </select>
                    <has-error :form="formedit" field="est_civ"></has-error>
                  </div>

                  <div class="form-group">
                    <label
                      ><span class="label-text">Número de Hijos:</span></label
                    >
                    <input
                      type="text"
                      v-model="formedit.num_childs"
                      name="fec_nac"
                      placeholder="Ingresa el número de hijos"
                      class="form-control"
                      :class="{
                        'is-invalid': formedit.errors.has('num_childs'),
                      }"
                    />
                    <has-error :form="formedit" field="num_childs"></has-error>
                  </div>

                  <div class="form-group">
                    <label
                      ><span class="label-text"
                        >Fecha de Nacimiento:</span
                      ></label
                    >
                    <date-picker
                      v-model="formedit.date_btd"
                      language="es"
                      style="width: 100%; display: block"
                      format="DD-MM-YYYY"
                      :class="{ 'is-invalid': formedit.errors.has('date_btd') }"
                    ></date-picker>
                    <has-error :form="formedit" field="date_btd"></has-error>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label
                      ><span class="label-text">Correo de Empresa:</span></label
                    >
                    <input
                      type="text"
                      name="email"
                      v-model="formedit.email"
                      placeholder="Ingresa el correo de la empresa"
                      class="form-control"
                      :class="{ 'is-invalid': formedit.errors.has('email') }"
                    />
                    <has-error :form="formedit" field="email"></has-error>
                  </div>

                  <div class="form-group">
                    <label
                      ><span class="label-text">Correo Personal:</span></label
                    >
                    <input
                      type="text"
                      name="fec_nac"
                      v-model="formedit.email_personal"
                      placeholder="Ingresa el correo personal"
                      class="form-control"
                      :class="{
                        'is-invalid': formedit.errors.has('email_personal'),
                      }"
                    />
                    <has-error
                      :form="formedit"
                      field="email_personal"
                    ></has-error>
                  </div>

                  <div class="form-group">
                    <label
                      ><span class="label-text">Celular Personal:</span></label
                    >
                    <input
                      type="text"
                      name="celphone_pri"
                      v-model="formedit.celphone_pri"
                      placeholder="Ingresa el celular personal"
                      class="form-control"
                      :class="{
                        'is-invalid': formedit.errors.has('celphone_pri'),
                      }"
                    />
                    <has-error
                      :form="formedit"
                      field="celphone_pri"
                    ></has-error>
                  </div>

                  <div class="form-group">
                    <label
                      ><span class="label-text"
                        >Celular Secundario:</span
                      ></label
                    >
                    <input
                      type="text"
                      name="celphone_sec"
                      v-model="formedit.celphone_sec"
                      placeholder="Ingresa el celular secundario"
                      class="form-control"
                      :class="{
                        'is-invalid': formedit.errors.has('celphone_sec'),
                      }"
                    />
                    <has-error
                      :form="formedit"
                      field="celphone_sec"
                    ></has-error>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label
                      ><span class="label-text"
                        >Celular de Empresa:</span
                      ></label
                    >
                    <input
                      type="text"
                      name="celphone_job"
                      v-model="formedit.celphone_job"
                      placeholder="Ingresa el celular de empresa"
                      class="form-control"
                      :class="{
                        'is-invalid': formedit.errors.has('celphone_job'),
                      }"
                    />
                    <has-error
                      :form="formedit"
                      field="celphone_job"
                    ></has-error>
                  </div>

                  <div class="form-group">
                    <label
                      ><span class="label-text">Dirección DNI:</span></label
                    >
                    <textarea
                      class="form-control"
                      v-model="formedit.adress_dni"
                      rows="3"
                      placeholder="Ingresa Dirección de DNI"
                      :class="{
                        'is-invalid': formedit.errors.has('adress_dni'),
                      }"
                    ></textarea>
                    <has-error :form="formedit" field="adress_dni"></has-error>
                  </div>

                  <div class="form-group">
                    <label
                      ><span class="label-text"
                        >Dirección Domicilio:</span
                      ></label
                    >
                    <textarea
                      class="form-control"
                      v-model="formedit.adress_home"
                      rows="3"
                      placeholder="Ingresa Dirección de domicilio"
                      :class="{
                        'is-invalid': formedit.errors.has('adress_home'),
                      }"
                    ></textarea>
                    <has-error :form="formedit" field="adress_home"></has-error>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Cerrar
              </button>
              <button
                v-if="notEmptyObject()"
                type="submit"
                class="btn btn-success"
              >
                Actualizar
              </button>
              <button v-else type="submit" class="btn btn-success">
                Guardar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.FIN MODAL -->
  </div>
</template>
<script>
import dayjs from 'dayjs';

export default {
  data() {
    return {
      sexs: [],
      status_civil: [],
      formedit: new Form({
        id: null,
        sex: null,
        date_btd: null,
        est_civ: null,
        num_childs: "",
        email: "",
        email_personal: "",
        celphone_pri: "",
        celphone_sec: "",
        celphone_job: "",
        adress_dni: "",
        adress_home: "",
      }),
    };
  },
  methods: {
    notEmptyObject() {
      return Object.keys(this.$parent.userDetail).length;
    },
    loadSexs() {
      axios.get("/api/select-sexs").then((response) => {
        this.sexs = response.data.sexs;
      });
    },
    loadCivilStatus() {
      axios.get("/api/select-civil-status").then((response) => {
        this.status_civil = response.data.status;
      });
    },
    newModal() {
      this.formedit.reset();
      $("#principal").find(".is-invalid").removeClass("is-invalid");
      $("#addNew").modal("show");
      this.formedit.errors.clear();
    },
    editModal() {
      var date = dayjs(this.$parent.userDetail.date_btd, "YYYY/MM/DD")
      console.log('fecha_nacimiento',date.$d);
      this.formedit.reset();
      $("#addNew").modal("show");
      this.formedit.fill(this.$parent.userDetail);
      this.formedit.date_btd = date.$d;
      this.formedit.errors.clear();
    },
    createUserDetail() {
      this.$Progress.start();
      this.formedit.id = this.$parent.user.id;
      this.formedit
        .post("/api/users-detail")
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Swal.fire("Actualizado!", "Se han actualizado los datos", "success");
          this.$emit("reloadUser", response.data.id_user);
          this.$Progress.finish();
          Fire.$emit("AfterCreate");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateUserDetail() {
      this.$Progress.start();
      this.formedit.id = this.$parent.user.id;
      this.formedit.put("/api/users-detail/" + this.$parent.user.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Swal.fire(
            "Actualizado!",
            "El elemento ha sido actualizado",
            "success"
          );
          this.$emit("reloadUser", response.data.id_user);
          this.$Progress.finish();
          Fire.$emit("AfterCreate");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
  },
  created() {
    this.loadSexs();
    this.loadCivilStatus();
    Fire.$on("AfterCreate", () => {});
    //setInterval(() => this.cargarAreas(), 3000);
  },
  mounted() {
    //console.log("datos", this.$parent.user.id);
  },
};
</script>