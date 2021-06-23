<template>
  <div class="container">
    <div class="row my-4">
      <div class="col-md-6 mx-auto">
        <form @submit.prevent="checkReference()">
          <div class="form-group">
            <div class="form-group">
              <input
                v-model="reference"
                type="text"
                class="form-control"
                placeholder="reference"
                id=""
              />
            </div>

            <div class="form-group">
              <button @click="redirection()" class="submit btn btn-primary">
                Continue
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      reference: "",
      isAuth: false,
    };
  },
  methods: {
    async checkReference() {
      const reference = {
        reference: this.reference,
      };

      var res = await fetch("http://localhost/Brief6/apiUser/checkReference", {
        method: "POST",
        header: "Content-type: application/json",

        body: JSON.stringify(reference),
      });

      if (res.status === 200) {
        const result = await res.json();

        if (result.reference_existe == "true") {
          sessionStorage.setItem("reference", this.reference);

          this.isAuth = true;
          this.redirection();
        } else {
          this.isAuth = false;
        }
      }
    },
    redirection() {
      if (this.isAuth == true) {
        this.$router.push({ path: "/dashboard" });
      } else {
        this.$router.push({ path: "/login" });
      }
    },
  },
};
</script>
