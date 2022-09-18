<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
import feather from "feather-icons";
defineProps(["designs"]);

onMounted(() => {
 feather.replace()
});
</script>
    
    <template>
  <Head title="Design List" />

  <AuthenticatedLayout>
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
        <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
        <!-- <div class="p-6 bg-white border-b border-gray-200"> -->
        <!-- <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
              <table
                class="
                  w-full
                  text-sm text-left text-gray-500
                  dark:text-gray-400
                "
              >
                <thead
                  class="
                    text-xs text-gray-700
                    uppercase
                    bg-gray-50
                    dark:bg-gray-700 dark:text-gray-400
                  "
                >
                  <tr>
                    <th scope="col" class="py-3 px-6">Design Code</th>
                    <th scope="col" class="py-3 px-6">No of pieces</th>
                    <th scope="col" class="py-3 px-6">Price</th>
                    <th scope="col" class="py-3 px-6">Size  </th>
                    <th scope="col" class="py-3 px-6">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="
                      bg-white
                      border-b
                      dark:bg-gray-900 dark:border-gray-700
                    "
                  >
                    <th
                      scope="row"
                      class="
                        py-4
                        px-6
                        font-medium
                        text-gray-900
                        whitespace-nowrap
                        dark:text-white
                      "
                    >
                      Apple MacBook Pro 17"
                    </th>
                    <td class="py-4 px-6">Sliver</td>
                    <td class="py-4 px-6">Laptop</td>
                    <td class="py-4 px-6">$2999</td>
                    <td class="py-4 px-6">
                      <a
                        href="#"
                        class="
                          font-medium
                          text-blue-600
                          dark:text-blue-500
                          hover:underline
                        "
                        >Edit</a
                      >
                    </td>
                  </tr>
                  <tr
                    class="
                      bg-gray-50
                      border-b
                      dark:bg-gray-800 dark:border-gray-700
                    "
                  >
                    <th
                      scope="row"
                      class="
                        py-4
                        px-6
                        font-medium
                        text-gray-900
                        whitespace-nowrap
                        dark:text-white
                      "
                    >
                      Microsoft Surface Pro
                    </th>
                    <td class="py-4 px-6">White</td>
                    <td class="py-4 px-6">Laptop PC</td>
                    <td class="py-4 px-6">$1999</td>
                    <td class="py-4 px-6">
                      <a
                        href="#"
                        class="
                          font-medium
                          text-blue-600
                          dark:text-blue-500
                          hover:underline
                        "
                        >Edit</a
                      >
                    </td>
                  </tr>
                  <tr
                    class="
                      bg-white
                      border-b
                      dark:bg-gray-900 dark:border-gray-700
                    "
                  >
                    <th
                      scope="row"
                      class="
                        py-4
                        px-6
                        font-medium
                        text-gray-900
                        whitespace-nowrap
                        dark:text-white
                      "
                    >
                      Magic Mouse 2
                    </th>
                    <td class="py-4 px-6">Black</td>
                    <td class="py-4 px-6">Accessories</td>
                    <td class="py-4 px-6">$99</td>
                    <td class="py-4 px-6">
                      <a
                        href="#"
                        class="
                          font-medium
                          text-blue-600
                          dark:text-blue-500
                          hover:underline
                        "
                        >Edit</a
                      >
                    </td>
                  </tr>
                  <tr
                    class="
                      bg-gray-50
                      border-b
                      dark:bg-gray-800 dark:border-gray-700
                    "
                  >
                    <th
                      scope="row"
                      class="
                        py-4
                        px-6
                        font-medium
                        text-gray-900
                        whitespace-nowrap
                        dark:text-white
                      "
                    >
                      Google Pixel Phone
                    </th>
                    <td class="py-4 px-6">Gray</td>
                    <td class="py-4 px-6">Phone</td>
                    <td class="py-4 px-6">$799</td>
                    <td class="py-4 px-6">
                      <a
                        href="#"
                        class="
                          font-medium
                          text-blue-600
                          dark:text-blue-500
                          hover:underline
                        "
                        >Edit</a
                      >
                    </td>
                  </tr>
                  <tr>
                    <th
                      scope="row"
                      class="
                        py-4
                        px-6
                        font-medium
                        text-gray-900
                        whitespace-nowrap
                        dark:text-white
                      "
                    >
                      Apple Watch 5
                    </th>
                    <td class="py-4 px-6">Red</td>
                    <td class="py-4 px-6">Wearables</td>
                    <td class="py-4 px-6">$999</td>
                    <td class="py-4 px-6">
                      <a
                        href="#"
                        class="
                          font-medium
                          text-blue-600
                          dark:text-blue-500
                          hover:underline
                        "
                        >Edit</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div> -->
        <!-- BEGIN: Data List -->
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
                    <Link class="flex items-center mr-3" :href="route('design.edit',design.id)">
                      <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                      Edit
                    </Link>
                    <a
                      class="flex items-center text-danger"
                      href="javascript:;"
                      data-tw-toggle="modal"
                      data-tw-target="#delete-confirmation-modal"
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
    