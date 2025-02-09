<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { watch } from "vue";

defineProps({
  show: {
    type: Boolean,
  },
  task: {
    type: [null, Object],
  },
  closeModal: {
    type: Function,
  },
});

const form = useForm({
  name: "",
  priority: "0",
});
</script>

<template></template>
