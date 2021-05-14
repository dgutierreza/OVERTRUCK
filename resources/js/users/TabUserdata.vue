<template>
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
</template>
<script>
export default {
  mounted() {
            console.log('datos',this.$parent.user);
        }
}
</script>