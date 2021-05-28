<template>
    <div class="container-fluid">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="/dist/img/profile.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{user.name_complete}}</h3>

                <p class="text-muted text-center">Software Engineer</p>
                <p class="text-muted text-center">DNI:{{user.dni}} </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Fec Inicio Laboral</b> <a class="float-right">{{user.created_at | formatDate}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Dias Trabajados</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Vacaciones Restantes</b> <a class="float-right">63</a>
                  </li>
                  <li class="list-group-item">
                    <b>Vacaciones Gozadas</b> <a class="float-right">3</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Descargar Record Vacacional</b></a>
              </div>
              <!-- /.card-body -->
            </div>
           
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Datos Personales</a></li>
                 
                  <li class="nav-item"><a class="nav-link" href="#salary" data-toggle="tab">Cuentas</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <TabUserdata @reloadUser='reloadUserParent'/>
                  <TabSalary/>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    
    </div>
</template>

<script>
import TabUserdata from './TabUserdata.vue';
import TabSalary from './TabSalary.vue';

    export default {
        data: () => ({
        user: {},
        userDetail:{},
    }),
    components: {
          TabUserdata,
          TabSalary
        },
    mounted() {
            console.log('Component mounted.')
        },
    created(){
          
        },
        methods:{
          
          reloadUserParent(id){
           axios.get ('/api/users/' + id).then ((data) => {
             this.userDetail=data.data.user_detail[0];
          });
          }
        },
    beforeRouteEnter (to, _from, next) {
        axios.get ('/api/users/' + to.params.id).then ((data) => {
            next ((vm) => {
                vm.user = data.data.user[0];
                if(data.data.user_detail!=null)
                {
                  vm.userDetail=data.data.user_detail[0];
                }
                                
            });
        });
    }
        
    }
</script>
