<template>
  <button
    type="button"
    class="btn btn-sm mb-3"
    :class="notification ? 'btn-success' : 'btn-secondary'"
  >
    {{ notification > 0 ? "New Notification" : "No new notification" }}
    <span class="badge badge-light">{{
      notification ? notification : ""
    }}</span>
  </button>
</template>

<script>
export default {
  data() {
    return {
      notification: 0
    };
  },
  mounted() {
    this.notification = this.$store.state.notificationCounter;
    this.listenToEvent();
  },
  methods: {
    listenToEvent() {
      console.log("trying to listen to an event..");
      Echo.channel("donate-channel").listen("Donated", e => {
        this.notification++;
        this.$store.commit("increment");
      });
    }
  }
};
</script>
