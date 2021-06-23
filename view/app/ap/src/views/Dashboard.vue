<template>
  <div class="container">
    <div class="row my-4">
      <div class="col-md-12 mx-auto">
        <!-- to show alert -->
        <div class="card">
          <div class="card-body bg-light">
            <!-- the add button -->
            <button
              @click="AjoutReseravtion()"
              class="btn btn-sm btn-primary mr-2 mb-2"
            >
              <i class="fas fa-plus">ADD</i>
            </button>
            <!-- the username and logout after click on it -->
            <a
              href="<?php echo BASE_URL;?>logout"
              title="DÃ©connexion"
              class="btn btn-link mr-2 mb-2"
            >
              <i class="fas fa-user mr-20"> </i>
            </a>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Time-on</th>
                  <th scope="col">Time-out</th>
                  <th scope="col">note</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="table in tables" :key="table.id_reservation">
                  <th scope="row">{{ table.jour }}</th>
                  <td>{{ table.time_on }}</td>
                  <td>{{ table.time_out }}</td>
                  <td>{{ table.note }}</td>

                  <td class="d-flex flex-row">
                    <!-- update and delete button -->
                    <form>
                      <!-- send us to update page with the id  -->
                      <input type="hidden" name="id" value="" />
                      <!-- send id  -->
                      <button
                        @click="edit(table)"
                        class="btn btn-sm btn-warning"
                      >
                        <i class="fa fa-edit"></i>
                      </button>
                    </form>
                    <form>
                      <!-- send us to delete page with the id  -->
                      <input type="hidden" name="id" value="" />
                      <button
                        @click="dele(table.id_reservation)"
                        class="btn btn-sm btn-danger"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Dashboard",

  data() {
    return {
      time_on: "",
      time_out: "",
      jour: "",
      id_reservation: "",
      note: "",
      tables: {},
      pageUpdate: false,
      pageAjouter: false,
    };
  },
  methods: {
    dele(id) {
      console.log(id);
      const data = {
        id_reservation: id,
      };

      var res = fetch(
        "http://localhost/Brief6/ApiCrudsReservation/suppReservation",
        {
          method: "POST",
          header: "Content-type: application/json",

          body: JSON.stringify(data),
        }
      );
      if (res.status === 200) {
        const result = res.json();
        console.log(result.message);
      }
    },
    AjoutReseravtion() {
      this.pageAjouter = true;
      this.pageUpdate = false;
      this.redirection();
    },

    edit(table) {
      this.pageUpdate = true;
      this.pageAjouter = false;
      sessionStorage.setItem("jour", table.jour);
      sessionStorage.setItem("time_on", table.time_on);
      sessionStorage.setItem("time_out", table.time_out);
      sessionStorage.setItem("note", table.note);
      sessionStorage.setItem("id_reservation", table.id_reservation);

      this.redirection();
    },
    redirection() {
      if (this.pageUpdate == true) {
        sessionStorage.setItem("pageAjouter", "");
        this.$router.push({ path: "/AjoutReservation" });
        sessionStorage.setItem("pageUpdate", "true");
      }

      if (this.pageAjouter == true) {
        sessionStorage.setItem("pageUpdate", "");
        this.$router.push({ path: "/AjoutReservation" });
        sessionStorage.setItem("pageAjouter", "true");
      }
    },
  },

  async created() {
    const reference = {
      reference: sessionStorage.getItem("reference"),
    };

    var res = await fetch(
      "http://localhost/Brief6/ApiCrudsReservation/afficherReservation",
      {
        method: "POST",
        header: "Content-type: application/json",

        body: JSON.stringify(reference),
      }
    );
    if (res.status === 200) {
      this.tables = await res.json();
    }
  },
};
</script>
