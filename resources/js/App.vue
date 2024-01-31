<script setup>
import {provide} from "vue";
import apiClient from "./axios.js";
import FeedbackForm from "./components/FeedbackForm.vue";

provide('axios', apiClient)
</script>

<template>
    <FeedbackForm />
</template>
