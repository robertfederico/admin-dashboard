<template>
  <div class="w-100">
    <LazyYoutube
      :src="source"
      max-width="100%"
      autoplay
      aspect-ratio="16:9"
      thumbnail-quality="standard"
    />
  </div>
</template>
  </div>
</template>

<script>
import { LazyYoutube, LazyVimeo } from "vue-lazytube";

export default {
  props: ["source"],
  components: {
    LazyYoutube,
    LazyVimeo,
  },
};
</script>

<style scoped>
#video {
  width: 1000px;
}
</style>