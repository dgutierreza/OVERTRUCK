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
                    <b>Fec Inicio Laboral</b> <a class="float-right">{{user.created_at}}</a>
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
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Datos Personales</a></li>
                  <li class="nav-item"><a class="nav-link" href="#docs" data-toggle="tab">Documentos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#holidays" data-toggle="tab">Vacaciones</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="personal">
                    <strong><i class="fas fa-user-edit"></i> Sexo:</strong> - <br/>
                    <strong><i class="fas fa-user-edit"></i> Estado Civil:</strong> - <br/>
                    <strong><i class="fas fa-child"></i> Num. Hijos:</strong> - <br/>
                    <strong><i class="fas fa-birthday-cake"></i> Fecha Nacimiento:</strong> - <br/>
                    <strong><i class="fas fa-envelope"></i> Correo Empresa:</strong> - <br/>
                    <strong><i class="fas fa-envelope"></i> Correo Personal:</strong> - <br/>
                    <strong><i class="fas fa-phone"></i> Celular Principal:</strong> - <br/>
                    <strong><i class="fas fa-phone"></i> Celular Secundario:</strong> - <br/>
                    <strong><i class="fas fa-phone"></i> Celular Trabajo:</strong> - <br/>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección Casa:</strong> - <br/>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección Dni:</strong> - <br/>
                    <strong><i class="fas fa-credit-card"></i> N° cuenta Sueldo:</strong> - <br/>
                    <strong><i class="fas fa-credit-card"></i> N° cuenta CTS:</strong> - <br/>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="docs">
                    AQUI VA docs
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="holidays">
                    AQUI VA vacaciones
                  </div>
                  <!-- /.tab-pane -->
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
    export default {
        data: () => ({
        user: {},
    }),
    beforeRouteEnter (to, _from, next) {
        axios
        .get ('/api/users/' + to.params.id).then ((data) => {
            next ((vm) => {
                vm.user = data.data[0];
            });
        });
    },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
