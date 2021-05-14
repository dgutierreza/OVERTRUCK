<template>
<div class="container-fluid">
   <div class="tab-pane active" id="personal">
    <strong><i class="fas fa-user-edit"></i> Sexo:</strong> - <br />
    <strong><i class="fas fa-user-edit"></i> Estado Civil:</strong> - <br />
    <strong><i class="fas fa-child"></i> Num. Hijos:</strong> - <br />
    <strong><i class="fas fa-birthday-cake"></i> Fecha Nacimiento:</strong> -
    <br />
    <strong><i class="fas fa-envelope"></i> Correo Empresa:</strong> - <br />
    <strong><i class="fas fa-envelope"></i> Correo Personal:</strong> - <br />
    <strong><i class="fas fa-phone"></i> Celular Principal:</strong> - <br />
    <strong><i class="fas fa-phone"></i> Celular Secundario:</strong> - <br />
    <strong><i class="fas fa-phone"></i> Celular Trabajo:</strong> - <br />
    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección Casa:</strong>
    - <br />
    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección Dni:</strong> -
    <br />
    <strong><i class="fas fa-credit-card"></i> N° cuenta Sueldo:</strong> -
    <br />
    <strong><i class="fas fa-credit-card"></i> N° cuenta CTS:</strong> - <br />
  </div>

    <button class="btn btn-primary float-sm-right" 
    @click="newModal">Editar Datos <i class="fas fa-user-edit"></i>
    </button>

  <!-- /.MODAL -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true" style="z-index:1100 !important;">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel"><strong></strong> {{this.$parent.user.name_complete}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                      <label> <span class="label-text">Sexo:</span></label>
                      <select class="form-control" name="sex" v-model="formedit.sex" :class="{ 'is-invalid': formedit.errors.has('sex') }">
                       <option v-for="sex in sexs" :key="sex.id" v-bind:value="sex.id" v-text="sex.name" :selected="formedit.sex==null"></option>                        
                      </select>
                      <has-error :form="formedit" field="sex"></has-error>
                      </div>
                    </div>
                  </div>  
                      
                  <div class="form-group">
                      <label><span class="label-text">Fecha de Nacimiento:</span></label>
                      <date-picker v-model="formedit.fec_nac" language="es" style="width:100%;display:block" format="DD-MM-YYYY" :class="{ 'is-invalid': formedit.errors.has('fec_nac') }"></date-picker>
                      <has-error :form="formedit" field="fec_nac"></has-error>
                  </div>    
                      
                  </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                
                </div>
            </div>
</div>
            <!-- /.FIN MODAL -->
</div>

</template>
<script>
export default {
  data(){
    return{
      sexs:[],
      formedit: new Form({
                    sex: null,
                    fec_nac:null,
                    est_civ: null,
                    num_hijos: '',
                    email: '',
                    email_personal: '',
                    cel_pri: '',
                    cel_sec: '',
                    cel_trabajo: '',
                    direccion_dni: '',
                    direccion_casa: ''
                })
    }
  },
  methods:{
    loadSexs()
          {
             axios.get('/api/select-sexs').then(response => {this.sexs = response.data.sexs;});
          },
    newModal(){
      
                $("#principal").find('.is-invalid').removeClass("is-invalid");
                $('#addNew').modal('show');
                
                this.form.errors.clear();
    },
  },
  created(){
          this.loadSexs();
          
          Fire.$on('AfterCreate',() => {
               //
           });
          //setInterval(() => this.cargarAreas(), 3000);
        },
  mounted() {
            console.log('datos',this.$parent.user.name_complete);
        }
}
</script>