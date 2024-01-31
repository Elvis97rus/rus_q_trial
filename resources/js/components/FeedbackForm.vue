<script setup>
import { ref, inject } from 'vue';

const form = ref({
    name: '',
    phone: '',
    message: '',
    success: false,
    submitted: false,
});
const form_errors = ref({
    name: '',
    phone: '',
    message: '',
});
const axios = inject('axios')

const submitForm = async () => {
    form.submitted = true
    try {
        const response = await axios.post('/feedback', form.value);
        console.log(response.data);

        form.value.name = ''
        form.value.phone = ''
        form.value.message = ''
        form.value.success = true

        form_errors.value.name = ''
        form_errors.value.phone = ''
        form_errors.value.message = ''

        setTimeout(() => {
            form.value.success = false
            form.submitted = false
        },5000)

    } catch (error) {
        form.submitted = false
        form_errors.value.name = error.response?.data?.errors?.name ?? ''
        form_errors.value.phone = error.response?.data?.errors?.phone ?? ''
        form_errors.value.message = error.response?.data?.errors?.message ?? ''
    }
};

</script>

<template>
    <div class="flex w-full flex-wrap justify-center">
        <div class="w-full text-center py-4 bg-white">
            <h1>Rus-Q Trial</h1>
        </div>
        <form v-if="!form.success" @submit.prevent="submitForm"
              class="mt-4 p-4 w-2/3 min-h-[300px] text-center bg-white">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Feedback Form</h2>

            <div class="mt-10 flex flex-col justify-between">
                <div class="flex justify-between">
                    <label for="name" class="block text-sm my-auto font-medium leading-6 text-gray-900 flex flex-col mx-auto">Name
                        <span v-if="form_errors.name" class=" text-red-500">{{form_errors.name[0]}}</span></label>
                    <div class="flex w-2/3 rounded-md shadow-sm ring-1 ring-inset ring-gray-300"
                         :class="form_errors.name ? 'ring-red-500' : 'ring-gray-300'">
                        <input v-model="form.name"
                               type="text" name="name" id="name" autocomplete="name"
                               class="outline-none block flex-1 border-0 bg-transparent py-3 pl-3 text-gray-900
                               placeholder:text-gray-400 sm:text-sm sm:leading-6" placeholder="John Doe" />
                    </div>
                </div>

                <div class="flex justify-between mt-4">
                    <label for="phone" class="block text-sm my-auto font-medium leading-6 text-gray-900 flex flex-col mx-auto">Phone
                        <span v-if="form_errors?.phone[0]" class=" text-red-500">{{form_errors?.phone[0]}}</span></label>
                    <div class="flex w-2/3 rounded-md shadow-sm ring-1 ring-inset ring-gray-300"
                         :class="form_errors.phone ? 'ring-red-500' : 'ring-gray-300'">
                        <input v-model="form.phone" type="text" name="phone" id="phone" autocomplete="phone" class="outline-none block
                        flex-1 border-0 bg-transparent py-3 pl-3 text-gray-900 placeholder:text-gray-400
                        sm:text-sm sm:leading-6" placeholder="79998881100" />
                    </div>
                </div>

                <div class="flex justify-between mt-4">
                    <label for="about" class="block text-sm font-medium leading-6 text-gray-900 flex flex-col mx-auto">Message
                        <span v-if="form_errors.message[0]" class=" text-red-500">{{form_errors.message[0]}}</span></label>

                     <textarea v-model="form.message"
                               id="about" name="about" rows="3"
                               :class="form_errors.message ? 'ring-red-500' : 'ring-gray-300'"
                               class="block w-2/3 rounded-md border-0 py-3 pl-3 border-1 ring-1 text-gray-900 shadow-sm outline-none
                                placeholder:text-gray-400 sm:text-sm sm:leading-6" />

                </div>

                <div class="flex justify-between mt-4">
                    <button :disabled="form.submitted"
                        type="submit" class="btn flex-1 rounded-md px-4 py-2 bg-green-400 w-1/3 text-center font-semibold text-2xl">Send</button>
                </div>


            </div>
        </form>
        <div v-else class="mt-4 p-4 w-1/3 min-h-[300px] text-center bg-white flex flex-col justify-center">
            <div class="w-2/3 p-4 text-center flex justify-center bg-white mx-auto">
                <p class=" w-full text-2xl text-black font-semibold">Ваша заявка принята! Спасибо за обращение!</p>
            </div>
        </div>
    </div>
</template>
