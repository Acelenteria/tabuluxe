<script setup>
import ManageRounds from '@/Components/ManageRounds.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue'
import { useForm, Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    contest: Object,
    'criterias': Array,
    'judges' : Array
})

// console.log(props.contest);
// console.log(props.criterias);

let form = useForm({
    name: props.contest.name,
    description: props.contest.description,
})

const submit = () => {
    form.put('/events/contest/' + props.contest.id)
}

let crit_form = useForm({
    criteria: '',
    description: '',
    weight: '',
})

const addCriteria = () => {
    crit_form.post('/events/contest/' + props.contest.id)
};

let contestIdToDelete = null

function confirmDelete(id) {
    contestIdToDelete = id
}

function deleteContest() {
        form.delete(route('contests.destroy', { contest: contestIdToDelete }));
}

let judge_form = useForm({
    name: '',
    passcode: '',
})

const addJudge = () => {
    judge_form.post('/events/contest/' + props.contest.id)
};

const generateRandomPasscode = () => {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let randomPasscode = '';
    for (let i = 0; i < 6; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        randomPasscode += characters.charAt(randomIndex);
    }
    judge_form.passcode = randomPasscode;
};

</script>

<template>
    <Head title="Contest(Setup)"></Head>
    <AuthLayout>
        <template #header>

            <h2 class="font-semibold text-xl text-[#ffbd59] leading-tight">
                {{ contest.name }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden border px-2 border-gray-900 shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="flex justify-around mt-2 mb-2 grid grid-cols-3">
                                <div class="px-6">
                                    <label for="name">Contest</label>
                                    <input type="text" v-model="form.name" id="name" class="ml-1 mb-2 form-control rounded font-bold text-md">
                                </div>

                                <div class="px-6">
                                    <label for="description">Description</label>
                                    <input type="text" v-model="form.description" id="description" class="ml-1 mb-2 form-control rounded font-bold  text-md">
                                </div>

                            <div class="mt-2 mb-2 px-6 grid grid-cols-2 gap-x-2">
                                <button class="rounded p-16 py-3 bg-green-400 font-bold" type="submit">Save</button>
                                <button class="rounded p-16 py-3 bg-red-500 font-bold"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" @click="confirmDelete(contest.id)">Delete</button>

                            </div>

                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-2 gap-x-6 mt-4">
                    <div class="bg-white overflow-hidden border px-2 border-gray-900 shadow-xl sm:rounded-lg">
                        <div class="flex justify-between mt-4">
                            <h1 class="px-4 py-3 text-2xl font-bold">Judges</h1>
                            <button type="button" class="bg-[#f0b55b] text-[#0c0c34] rounded px-4 py-2 text-uppercase font-bold hover:bg-[#0c0c34] hover:text-[#f0b55b] " data-bs-toggle="modal" data-bs-target="#staticJudgeBackdrop">Add</button>
                        </div>

                        <div class="mt-2">
                            <table class="min-w-full divide-y divide-gray-200 border-separate border-spacing-2 border border-slate-500 rounded">
                                <thead>
                                    <tr>
                                        <th class="text-center px-4 py-3 text-left text-xs leading-4 font-bold text-white uppercase tracking-wider bg-blue-900">Name</th>
                                        <th class="text-center px-4 py-3 text-left text-xs leading-4 font-bold text-white uppercase tracking-wider bg-blue-900">Passcode</th>
                                        <th class="text-center px-4 py-3 text-left text-xs leading-4 font-bold text-white uppercase tracking-wider bg-blue-900">...</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-if="judges.length === 0">
                                        <td colspan="3" class="text-center py-4">No judges yet</td>
                                    </tr>
                                    <tr v-for="judge in judges" :key="judge.id">
                                        <td class="px-6 py-4 whitespace-no-wrap border border-slate-700">{{ judge.name }}</td>
                                        <td class="whitespace-no-wrap text-center border border-slate-700">{{ judge.passcode }}</td>

                                        <td class="whitespace-no-wrap text-center border border-slate-700">
                                            <button>
                                                <Link :href="route('contests.show', contest.id )" :active="route().current('events')">View</Link>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <ManageRounds />

                </div>

            </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3 text-center">
                                <h1 class="text-xl">Are you sure you want to delete this Event?</h1>
                                <h1 class="text-md text-gray-500 mt-4">By confirming this, you will delete the contests inside the Event</h1>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn bg-gray-400 btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button  class="btn bg-red-600 btn-primary" data-bs-dismiss="modal" @click="deleteContest()">Delete</button>
                            </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="staticJudgeBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addJudge">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control rounded" id="name" v-model="judge_form.name">
                            </div>

                            <label for="passcode" class="form-label">Passcode</label>
                            <div class="mb-3 flex gap-x-2">
                                <input type="text" class="form-control rounded" id="passcode" v-model="judge_form.passcode">
                                <button class="btn btn-primary " @click="generateRandomPasscode">Generate Passcode</button>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn bg-gray-400 btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button  class="btn bg-red-600 btn-primary" type="submit" data-bs-dismiss="modal">Add</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

    </AuthLayout>


</template>
