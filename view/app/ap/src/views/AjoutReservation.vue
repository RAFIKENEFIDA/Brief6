<template>
  <div class="container">
    <div class="row my-4">
      <div class="col-md-8 mx-auto">
        <!-- to show alert -->
        <div class="card">
          <div class="card-header">Class Reservation</div>
          <div class="card-body bg-light">
            <a class="btn btn-sm btn-secondary mr-2 mb-2">
              <i class="fas fa-home"></i>
            </a>

            <form @submit.prevent="inserer()">
              <div class="form-group">
                <label for="nom">Date*</label>
                <input
                  v-model="jour"
                  @change="chekCreneau()"
                  type="date"
                  class="form-control"
                  required
                />
              </div>

              <div class="form-group">
                <label for="prenom">Note*</label>
                <textarea
                  v-model="note"
                  class="form-control"
                  placeholder="note"
                  required
                ></textarea>
              </div>

              <div class="form-group">
                <label for="prenom">Horaire*</label>
                <select class="form-control" required v-model="id">
                  <option
                    v-for="(stoke, index) in stokes"
                    :value="stoke"
                    :key="index"
                    >{{ stoke.time_on }} To {{ index }}
                    {{ stoke.time_out }}</option
                  >
                </select>
              </div>
              <button class=" submit btn btn-primary">
                Reserver
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "AjoutReservation",
  data() {
    return {
      stokes: {},
      time_on: "",
      time_out: "",
      jour: "",
      note: "",
      id: undefined,
      id_reservation: undefined,
      toDashboard: false,
      rp: "",
    };
  },
  methods: {
    async chekCreneau() {
      console.log(sessionStorage.getItem("pageAjouter"));
      console.log(sessionStorage.getItem("pageUpdate"));
      console.log(12);
      const data = {
        jour: this.jour,
      };
      console.log(data.jour);
      var res = await fetch(
        "http://localhost/Brief6/ApiCrudsReservation/recupererCreneau",
        {
          method: "POST",
          header: "Content-type: application/json",

          body: JSON.stringify(data),
        }
      );

      if (res.status === 200) {
        this.stokes = await res.json();
        console.log(this.stokes);
      }
    },

    async inserer() {
      if (sessionStorage.getItem("pageAjouter") == "true") {
        console.log(sessionStorage.getItem("pageAjouter"));
        console.log(this.id);

        const data = {
          time_on: this.id.time_on,
          time_out: this.id.time_out,
          jour: this.jour,
          note: this.note,
          reference: sessionStorage.getItem("reference"),
        };
        console.log(data);
        var res = await fetch(
          "http://localhost/Brief6/ApiUser/inserteReservation",
          {
            method: "POST",
            header: "Content-type: application/json",

            body: JSON.stringify(data),
          }
        );

        if (res.status === 200) {
          this.toDashboard = true;
          this.redirection();
        }
      } else if (sessionStorage.getItem("pageUpdate") == "true") {
        const info = {
          time_on: this.id.time_on,
          time_out: this.id.time_out,
          jour: this.jour,
          note: this.note,
          id_reservation: this.id_reservation,
        };

        var rese = await fetch(
          "http://localhost/Brief6/ApiCrudsReservation/updateReservation",
          {
            method: "POST",
            header: "Content-type: application/json",

            body: JSON.stringify(info),
          }
        );

        if (rese.status === 200) {
          this.toDashboard = true;
          this.redirection();
        }
      }
    },

    redirection() {
      if (this.toDashboard == true) {
        this.$router.push({ path: "/dashboard" });
      }
    },
  },
  async created() {
    if (sessionStorage.getItem("pageUpdate") == "true") {
      console.log(sessionStorage.getItem("pageUpdate"));
      this.jour = sessionStorage.getItem("jour");
      this.note = sessionStorage.getItem("note");
      this.id_reservation = sessionStorage.getItem("id_reservation");
    }
  },
};
</script>
