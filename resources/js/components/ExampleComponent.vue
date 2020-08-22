<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">
            I'm an example component.
            <pre>{{ nice }}</pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nices: "",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  props: {
    nice: String,
  },
};
</script>
