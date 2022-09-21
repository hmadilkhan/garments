<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed, onMounted, ref } from "vue";
import feather from "feather-icons";
import { useForm, Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

defineProps(["accountTypes","accounts"]);


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
  account_type_id: "",
  code: "",
  title: "",
});

function submit() {
    console.log(isUpdate.value);
    if (isUpdate.value == true) {
        Inertia.put(route("main-account.update",form.id),form,{
        onSuccess: () => {
            form.reset()
            feather.replace()
            changeUpdate(false)
        },

    });
    }else{
        Inertia.post(route("main-account.store"),form,{
            onSuccess: () => {
                form.reset()
                feather.replace()
            },

        });
    }


}
function edit(id,account_type_id,code,title) {
    this.form.id = id;
    this.form.account_type_id = account_type_id;
    this.form.code = code;
    this.form.title = title;
    changeUpdate(true)
}

function deleteUnit(id) {
    Inertia.delete(route("main-account.destroy",id))
}
function cancel(){
    form.reset();
    changeUpdate(false)
}
</script>
 <template>
 <Head title="Sellers List" />
 <AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Main Accounts List
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
                for="grid-first-name"
              >
                Account Type
              </label>
              <select v-model="form.account_type_id" class="
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
                ">
                <option v-for="type in accountTypes" :key="type.id" :value="type.id">{{type.name}}</option>
              </select>
              <InputError
                :message="form.errors.account_type_id"
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
                for="grid-first-name"
              >
                Code
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
                placeholder="Account Code"
              />
              <InputError
                :message="form.errors.code"
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
                for="grid-first-name"
              >
                Title
              </label>
              <input
                v-model="form.title"
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
                placeholder="Account Title"
              />
              <InputError
                :message="form.errors.title"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>


            <div class="w-full md:w-1/2 px-3 mt-3 md:mb-0">
            </div>
            <div class="w-full md:w-1/2 px-3 mt-3 md:mb-0">
              <button @click="cancel" type="button" class="float-right mt-4 ml-2 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
               Cancel
              </button>
              <PrimaryButton class="mt-4 float-right " >{{buttonName}}</PrimaryButton>
            </div>
          </div>
        </form>
      </div>
       <div class="intro-y col-span-6 overflow-auto lg:overflow-visible">
          <table class="table table-report -mt-2">
            <thead>
              <tr>
                <th class="text-center whitespace-nowrap">ACCOUNT CODE</th>
                <th class="text-center whitespace-nowrap">ACCOUNT TITLE</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="account in accounts" :key="account.id" class="intro-x">
                    <td class="text-center">{{ account.code }}</td>
                    <td class="text-center">{{ account.title }}</td>
                    <td class="table-report__action w-56">
                  <div class="flex justify-center items-center">
                    <a
                      class="flex items-center mr-3 cursor-pointer"
                      @click="edit(account.id,account.account_type_id,account.code,account.title)"
                    >
                      <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                      Edit
                    </a>
                    <a
                      class="flex items-center text-danger cursor-pointer"
                      @click="deleteUnit(account.id)"
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
