<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed, onMounted, ref } from "vue";
import feather from "feather-icons";
import { useForm, Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

defineProps(["vouchers","subaccounts"]);


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
  from_account: "",
  to_account: "",
  amount: "",
  narration: "",
});

function submit() {
    console.log(form);
    if (isUpdate.value == true) {
        Inertia.put(route("voucher.update",form.id),form,{
        onSuccess: () => {
            form.reset()
            feather.replace()
            changeUpdate(false)
        },

    });
    }else{
        form.post(route("voucher.store"),form,{
            onSuccess: () => {
                form.reset()
                feather.replace()
            },

        });
    }


}
function edit(id,from_account,to_account,amount,narration) {
    this.form.id = id;
    this.form.from_account = from_account;
    this.form.to_account = to_account;
    this.form.amount = amount;
    this.form.narration = narration;
    changeUpdate(true)
}

function deleteUnit(id) {
    Inertia.delete(route("voucher.destroy",id))
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
            Vouchers List
        </h2>
    </template>
    <div class="py-6">
      <div class="sm:px-6 lg:px-8">
        <form
          @submit.prevent="submit"
          class="w-full border-b border-gray-200"
        >
          <div class="flex flex-wrap -mx-3 mb-6">
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
                From Account
              </label>
              <select v-model="form.from_account" class="
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
                <option v-for="subaccount in subaccounts" :key="subaccount.id"  :value="subaccount.id">{{subaccount.title}} | ({{subaccount.mainaccount.title}})</option>
              </select>
              <InputError
                :message="form.errors.from_account"
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
                To Account
              </label>
              <select v-model="form.to_account" class="
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
                <option v-for="subaccount in subaccounts" :key="subaccount.id"  :value="subaccount.id">{{subaccount.title}} | ({{subaccount.mainaccount.title}})</option>
              </select>
              <InputError
                :message="form.errors.to_account"
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
                Amount
              </label>
              <input
                v-model="form.amount"
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
                placeholder="Enter Amount"
              />
              <InputError
                :message="form.errors.amount"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>
            <div class="w-full md:w-full px-3 mb-6 md:mb-0">
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
                Narration
              </label>
              <input
                v-model="form.narration"
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
                placeholder="Narration"
              />
              <InputError
                :message="form.errors.narration"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>


            <!-- <div class="w-full md:w-1/2 px-3 mt-3 md:mb-0">
            </div> -->
            <div class="w-full md:w-full px-3 mt-3 md:mb-0">
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
                <th class="text-center whitespace-nowrap">FROM ACCOUNT</th>
                <th class="text-center whitespace-nowrap">TO ACCOUNT</th>
                <th class="text-center whitespace-nowrap">AMOUNT</th>
                <th class="text-center whitespace-nowrap">NARRATION</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="voucher in vouchers" :key="voucher.id" class="intro-x">
                    <td class="text-center">{{ voucher.fromaccount.title }}</td>
                    <td class="text-center">{{ voucher.toaccount.title }}</td>
                    <td class="text-center">{{ voucher.amount }}</td>
                    <td class="text-center">{{ voucher.narration }}</td>
                    <td class="table-report__action w-56">
                  <div class="flex justify-center items-center">
                    <a
                      class="flex items-center mr-3 cursor-pointer"
                      @click="edit(voucher.id,voucher.from,voucher.to,voucher.amount,voucher.narration)"
                    >
                      <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                      Edit
                    </a>
                    <a
                      class="flex items-center text-danger cursor-pointer"
                      @click="deleteUnit(voucher.id)"
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
