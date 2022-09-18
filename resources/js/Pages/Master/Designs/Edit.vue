<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["design"]);

const form = useForm({
  code: props.design.code,
  qty: props.design.qty,
  price: props.design.price,
  size: props.design.size,
  image: "",
});

function submit() {
  // form.post(route('design.update',props.design.id,{ _method: 'put'}))
  Inertia.post(route('design.update',props.design.id), {
    _method: "put",
    data: form,
  });
}
</script>
            
    <template>
  <Head title="Add New Design" />

  <AuthenticatedLayout>
    <div class="py-6">
      <div class="sm:px-6 lg:px-8">
        <Link
          type="button"
          :href="route('design.index')"
          class="
            focus:outline-none
            text-white
            bg-green-700
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
          >Back to Design</Link
        >
        <div class="overflow-hidden shadow-sm sm:rounded-lg bg-white">
          <div class="p-6">
            <form
              @submit.prevent="submit"
              class="w-full border-b border-gray-200"
              enctype="multipart/form-data"
            >
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <label
                    class="
                      block
                      uppercase
                      tracking-wide
                      text-gray-700 text-xs
                      font-bold
                      mb-2
                    "
                    for="grid-first-name"
                  >
                    Design Code
                  </label>
                  <input
                    v-model="form.code"
                    class="
                      appearance-none
                      block
                      w-full
                      bg-gray-200
                      text-gray-700
                      rounded
                      py-3
                      px-4
                      mb-3
                      leading-tight
                      focus:outline-none focus:bg-white
                    "
                    id="grid-first-name"
                    type="text"
                    placeholder="Design Code"
                  />
                  <InputError
                    :message="form.errors.code"
                    class="mt-2 text-red-500 text-xs italic"
                  />
                </div>
                <div class="w-full md:w-1/2 px-3">
                  <label
                    class="
                      block
                      uppercase
                      tracking-wide
                      text-gray-700 text-xs
                      font-bold
                      mb-2
                    "
                    for="grid-last-name"
                  >
                    No of pieces
                  </label>
                  <input
                    v-model="form.qty"
                    class="
                      appearance-none
                      block
                      w-full
                      bg-gray-200
                      text-gray-700
                      border border-gray-200
                      rounded
                      py-3
                      px-4
                      leading-tight
                      focus:outline-none focus:bg-white focus:border-gray-500
                    "
                    id="grid-last-name"
                    type="text"
                    placeholder="Doe"
                  />
                  <InputError
                    :message="form.errors.qty"
                    class="mt-2 text-red-500 text-xs italic"
                  />
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label
                    class="
                      block
                      uppercase
                      tracking-wide
                      text-gray-700 text-xs
                      font-bold
                      mb-2
                    "
                    for="grid-city"
                  >
                    Sizes
                  </label>
                  <input
                    v-model="form.size"
                    class="
                      appearance-none
                      block
                      w-full
                      bg-gray-200
                      text-gray-700
                      border border-gray-200
                      rounded
                      py-3
                      px-4
                      leading-tight
                      focus:outline-none focus:bg-white focus:border-gray-500
                    "
                    id="grid-city"
                    type="text"
                    placeholder="Enter Size"
                  />
                  <InputError
                    :message="form.errors.size"
                    class="mt-2 text-red-500 text-xs italic"
                  />
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label
                    class="
                      block
                      uppercase
                      tracking-wide
                      text-gray-700 text-xs
                      font-bold
                      mb-2
                    "
                    for="grid-state"
                  >
                    Sale Price
                  </label>
                  <div class="relative">
                    <input
                      v-model="form.price"
                      class="
                        appearance-none
                        block
                        w-full
                        bg-gray-200
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        px-4
                        leading-tight
                        focus:outline-none focus:bg-white focus:border-gray-500
                      "
                      id="grid-city"
                      type="text"
                      placeholder="Enter Price"
                    />
                    <InputError
                      :message="form.errors.price"
                      class="mt-2 text-red-500 text-xs italic"
                    />
                    <div
                      class="
                        pointer-events-none
                        absolute
                        inset-y-0
                        right-0
                        flex
                        items-center
                        px-2
                        text-gray-700
                      "
                    ></div>
                  </div>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                  <label
                    class="
                      block
                      uppercase
                      tracking-wide
                      text-gray-700 text-xs
                      font-bold
                      mb-2
                    "
                    for="grid-zip"
                  >
                    Image
                  </label>
                  <input
                    class="
                      appearance-none
                      block
                      bg-white
                      w-full
                      bg-gray-200
                      text-gray-700
                      border border-gray-200
                      rounded
                      py-3
                      px-4
                      leading-tight
                      focus:outline-none focus:bg-white focus:border-gray-500
                    "
                    @input="form.image = $event.target.files[0]"
                    id="grid-zip"
                    name="file"
                    type="file"
                    placeholder="90210"
                  />
                </div>
              </div>
              <PrimaryButton class="mt-4 float-right mb-4">Save</PrimaryButton>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
          