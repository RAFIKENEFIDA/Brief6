<template>
  <div class="container">
    <div class="row my-4">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-header">
            <span v-html="alert_msg"></span>
            <span v-html="alert_ref"></span>
            <h3 class="card-title">
              Inscription
            </h3>
          </div>
          <div class="card-body">
            <form class="mr-1" @submit.prevent="inscriptionSubmit()">
              <div class="form-group">
                <input
                  type="text"
                  v-model="nom"
                  class="form-control"
                  name="nom"
                  required
                  autocomplete="off"
                  placeholder="Nom"
                  id=""
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  v-model="prenom"
                  autocomplete="off"
                  class="form-control"
                  name="prenom"
                  placeholder="Prenom"
                  id=""
                />
              </div>
              <div class="form-group">
                <input
                  type="date"
                  v-model="date_naissance"
                  @change="addnaissance"
                  autocomplete="off"
                  class="form-control"
                  name="age"
                  placeholder="date-naissance"
                  id=""
                />
              </div>

              <div class="form-group">
                <button class=" submit btn btn-primary">
                  Inscription
                </button>
              </div>
            </form>
          </div>
          <div class="card-footer">
            <router-link to="/login">
              <button class=" submit btn btn-primary">
                Continue
              </button>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignupForm",

  data() {
    return {
      nom: "",
      prenom: "",
      date_naissance: "",
      reference: "",
      alert_msg: "",
      alert_ref: "",
    };
  },
  methods: {
    addnaissance() {
      console.log(this.date_naissance);
    },
    async inscriptionSubmit() {
      const data = {
        nom: this.nom,
        prenom: this.prenom,
        date_naissance: this.date_naissance,
      };
      console.log(data);

      var res = await fetch("http://localhost/Brief6/apiUser/creatUser", {
        method: "POST",
        header: "Content-type: application/json",

        body: JSON.stringify(data),
      });

      if (res.status === 200) {
        const result = await res.json();
        if (result) {
          this.alert_msg = `<div
              class="alert alert-success d-flex align-items-center"
              role="alert"
            >
              <svg
                class="bi flex-shrink-0 me-2"
                width="24"
                height="24"
                role="img"
                aria-label="Success:"
              >
                <use xlink:href="#check-circle-fill" />
              </svg>
              <div> Félicitation Votre inscription est effectuer</div>
            </div>`;
          this.alert_ref = ` <div
              class="alert alert-primary d-flex align-items-center"
              role="alert"
            >
              <svg
                class="bi flex-shrink-0 me-2"
                width="24"
                height="24"
                role="img"
                aria-label="Info:"
              >
                <use xlink:href="#info-fill" />
              </svg>
              <div>votre code de reference est: ${result.reference}</div>
            </div>`;

          console.log(result.reference);
        }
      }
    },
  },
};
</script>

<style>
form {
  max-width: 420px;
  margin: 30px auto;
  text-align: left;
  padding: 40px;
  background: white;
}
label {
  color: #aaa;
  display: inline-block;
  margin: 25px 0 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
inline {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border-bottom: 1px solid #ddd;
  color: #555;
}
</style>
