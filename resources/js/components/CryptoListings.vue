<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <pre v-if="!isLoaded">Loading..</pre>
        <div v-if="isLoaded && dataListings.data">
          <template v-for="(listing, key) in dataListings.data.slice(0, dataLoadedCounter)">
            <pre :key="key">{{listing.name}} ({{listing.symbol}}) {{currencyFormat(listing.quote.IDR.price)}}</pre>
          </template>
          <button
            v-if="dataLoadedCounter < dataListings.data.length"
            class="btn btn-primary btn-sm"
            v-on:click="dataLoadedCounter += 5"
          >Show more</button>
          <button v-else class="btn btn-primary btn-sm" v-on:click="dataLoadedCounter = 5">Show Less</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dataListings: [],
      isLoaded: false,
      dataLoadedCounter: 5,
    };
  },
  async mounted() {
    this.dataListings = await this.loadListings();
  },
  methods: {
    async loadListings() {
      const response = await fetch("/api/listings");
      const result = await response.json();
      this.isLoaded = true;
      return result;
    },
    currencyFormat(num) {
      return "Rp " + num.toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    },
  },
};
</script>
