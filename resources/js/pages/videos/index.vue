<template>
  <div class="card shadow mt-4">
    <div class="card-header">
      <h4>Simple Video Player</h4>
    </div>
    <div class="card-body">
      <input
        class="form-control mb-2"
        type="text"
        @keydown.enter="handleSearch($event)"
        placeholder="Youtube Video Link"
        :value="source"
      />
      <VideoPlayer :source="source" />
    </div>
  </div>
</template>

<script>
import VideoPlayer from "./VideoPlayer";

export default {
  components: { VideoPlayer },
  data() {
    return {
      source: "https://www.youtube.com/watch?v=qZXt1Aom3Cs",
    };
  },
  methods: {
    handleSearch(e) {
      this.source = e.target.value;
    },
  },
};
</script>

<style lang="scss" scoped>
</style> 