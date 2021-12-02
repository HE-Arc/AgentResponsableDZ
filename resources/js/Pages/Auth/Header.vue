<template>
  <Head title="Header" />
    <breeze-button class="ms-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
    <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    Menu
    </breeze-button>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from "@/Layouts/Guest.vue"
import BreezeLabel from '@/Components/Label.vue'
import { Head } from '@inertiajs/inertia-vue3'

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeLabel,
    Head,
  },

  data() {
    return {
      form: this.$inertia.form({
        password: '',
      })
    }
  },

  methods: {
    show_menu() {
      console.log('bonjour')
    }
  }
}
</script>
