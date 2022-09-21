<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteModal from "@/Components/DeleteModal.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";
import feather from "feather-icons";
defineProps(["designs"]);
// let isOpen = ref(false);
onMounted(() => {
  feather.replace();
});

function deleteDesign(event) {}
</script>

    <template>
  <Head title="Design List" />

  <AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Designs List
        </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <Link
          type="button"
          :href="route('design.create')"
          class="
            focus:outline-none
            text-white
            bg-green-900
            hover:bg-green-800
            focus:ring-4 focus:ring-green-300
            font-medium
            rounded-lg
            text-sm
            px-5
            py-2.5
            mr-2
            mb-2
            dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800
          "
          >Add New Design</Link
        >
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
          <table class="table table-report -mt-2">
            <thead>
              <tr>
                <th class="whitespace-nowrap">IMAGE</th>
                <th class="whitespace-nowrap">DESIGN CODE</th>
                <th class="text-center whitespace-nowrap">STOCK</th>
                <th class="text-center whitespace-nowrap">PRICE</th>
                <th class="text-center whitespace-nowrap">SIZE</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="design in designs" :key="design.id" class="intro-x">
                <td class="w-40">
                  <div class="flex">
                    <div class="w-10 h-10 image-fit zoom-in">
                      <img
                        alt="Tinker Tailwind HTML Admin Template"
                        class="tooltip rounded-full"
                        :src="`/storage/design/${design.image}`"
                        title="Uploaded at 31 August 2022"
                      />
                    </div>
                  </div>
                </td>
                <td>
                  <a href="" class="font-medium whitespace-nowrap">{{
                    design.code
                  }}</a>
                </td>
                <td class="text-center">{{ design.qty }}</td>
                <td class="w-40 text-center">{{ design.price }}</td>
                <td class="w-40 text-center">{{ design.size }}</td>
                <td class="table-report__action w-56">
                  <div class="flex justify-center items-center">
                    <Link
                      class="flex items-center mr-3"
                      :href="route('design.edit', design.id)"
                    >
                      <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                      Edit
                    </Link>
                    <a
                      class="flex items-center text-danger"
                      @click="deleteDesign"
                    >
                      <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                      Delete
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- END: Data List -->
        <!-- </div> -->
      </div>
    </div>
    <!-- </div> -->

  </AuthenticatedLayout>
</template>
