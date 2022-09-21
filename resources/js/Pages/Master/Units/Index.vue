<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed, onMounted, ref } from "vue";
import feather from "feather-icons";
import { useForm, Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

defineProps(["units"]);


let isUpdate = ref(false);
function changeUpdate(value){
    isUpdate.value = value;
}

const buttonName = computed(() => isUpdate.value == true ? "Update" : "Save");

onMounted(() => {
    feather.replace();
});

const form = useForm({
  id: "",
  name: "",
});

function submit() {
    console.log(isUpdate.value);
    if (isUpdate.value == true) {
        Inertia.put(route("unit.update",form.id),form,{
        onSuccess: () => {
            form.reset()
            feather.replace()
            changeUpdate(false)
        },

    });
    }else{
        Inertia.post(route("unit.store"),form,{
            onSuccess: () => {
                form.reset()
                feather.replace()
            },

        });
    }


}
function edit(id,name) {
    this.form.id = id;
    this.form.name = name;
    changeUpdate(true)
}

function deleteUnit(id) {
    Inertia.delete(route("unit.destroy",id))
}
function cancel(){
    form.reset();
    changeUpdate(false)
}
</script>
 <template>
  <Head title="Units List" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Units List
      </h2>
    </template>
    <div class="py-6">
      <div class="sm:px-6 lg:px-8">
        <form
          @submit.prevent="submit"
          class="w-full border-b border-gray-200"
        >
          <div class="flex flex-wrap -mx-3 mb-6">
            <input type="hidden" v-model="form.id"/>
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
                Unit of Measure Name
              </label>
              <input
                v-model="form.name"
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
                placeholder="Unit of Measure Name"
              />
              <InputError
                :message="form.errors.name"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>
            <div class="w-full md:w-1/2 px-3 mt-3 md:mb-0">
              <PrimaryButton class="mt-4 float-left" >{{buttonName}}</PrimaryButton>
              <button @click="cancel" type="button" class="mt-4 ml-4 float-left inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
               Cancel
              </button>
            </div>
          </div>
        </form>
      </div>
       <div class="intro-y col-span-6 overflow-auto lg:overflow-visible">
          <table class="table table-report -mt-2">
            <thead>
              <tr>
                <th class="text-center whitespace-nowrap">Unit</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="unit in units" :key="unit.id" class="intro-x">
                    <td class="text-center">{{ unit.name }}</td>
                    <td class="table-report__action w-56">
                  <div class="flex justify-center items-center">
                    <a
                      class="flex items-center mr-3 cursor-pointer"
                      @click="edit(unit.id,unit.name)"
                    >
                      <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                      Edit
                    </a>
                    <a
                      class="flex items-center text-danger cursor-pointer"
                      @click="deleteUnit(unit.id)"
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
    </div>
  </AuthenticatedLayout>
</template>
