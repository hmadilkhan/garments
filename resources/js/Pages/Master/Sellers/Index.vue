<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
import feather from "feather-icons";

defineProps(["designs"]);

onMounted(() => {
  feather.replace();
});
</script>
 <template>
 <Head title="Sellers List" />
 <AuthenticatedLayout>

  </AuthenticatedLayout>
 </template>
