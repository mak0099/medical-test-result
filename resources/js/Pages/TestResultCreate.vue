<template>
    <app-layout title="Test Result">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-1">
                            <section class="py-1 bg-blueGray-50">
                                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 rounded">
                                    <div class="p-2 float-right" v-if="message">
                                        <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded relative" role="alert">
                                            <span class="block sm:inline">{{message}}</span>
                                            <span class="absolute top-0 bottom-0 right-0 px-3 py-2" @click="message=''">
                                                <svg class="fill-current h-3 w-3 text-green-500" role="button" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-2 float-right" v-if="error">
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded relative" role="alert">
                                            <span class="block sm:inline">{{error}}</span>
                                            <span class="absolute top-0 bottom-0 right-0 px-3 py-2" @click="error=''">
                                                <svg class="fill-current h-3 w-3 text-red-500" role="button" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                                        <div class="flex flex-wrap items-center">
                                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                                <h3 class="font-semibold text-base text-blueGray-700">
                                                    New Test Result
                                                </h3>
                                            </div>
                                            <div v-if="form.id" class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                                <button
                                                    class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                    type="button"
                                                    @click="create()"
                                                >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                    New
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="block w-full overflow-x-auto p-4">
                                        <form @submit.prevent="submit">
                                            <div class="flex flex-wrap -mx-3 mb-6 px-4">
                                                <div class="w-full md:w-2/4 px-3 mb-6 md:mb-2">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                        Patient Name
                                                    </label>
                                                    <input v-model="form.patient_name" required class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white" type="text">
                                                    <p v-if="form.errors.patient_name" class="text-red-500 text-xs italic">{{form.errors.patient_name}}</p>
                                                </div>
                                                <div class="w-full md:w-1/4 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                        Age <small>(Y)</small>
                                                    </label>
                                                    <input v-model="form.patient_age" min="0" max="150" required class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number">
                                                    <p v-if="form.errors.patient_age" class="text-red-500 text-xs italic">{{form.errors.patient_age}}</p>
                                                </div>
                                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-2">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                                        Sex
                                                    </label>
                                                    <div class="relative">
                                                        <select v-model="form.patient_sex" required class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                                            <option>Male</option>
                                                            <option>Female</option>
                                                            <option>Other</option>
                                                        </select>
                                                    </div>
                                                    <p v-if="form.errors.patient_sex" class="text-red-500 text-xs italic">{{form.errors.patient_sex}}</p>
                                                </div>
                                                <div class="w-full md:w-3/4 px-3 mb-6 md:mb-2">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                        Refd By
                                                    </label>
                                                    <input v-model="form.refd_by" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white" type="text">
                                                    <p v-if="form.errors.refd_by" class="text-red-500 text-xs italic">{{form.errors.refd_by}}</p>
                                                </div>
                                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-2">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                                        Specimen
                                                    </label>
                                                    <div class="relative">
                                                        <select v-model="form.specimen" required class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                                            <option>Blood</option>
                                                            <option>Urine</option>
                                                            <option>Swab</option>
                                                            <option>Other</option>
                                                        </select>
                                                    </div>
                                                    <p v-if="form.errors.specimen" class="text-red-500 text-xs italic">{{form.errors.specimen}}</p>
                                                </div>
                                                <h1 class="p-3">Test Result</h1>
                                                <div class="block w-full px-3">
                                                    <table class="w-full border-collapse border table-fixed">
                                                        <thead>
                                                            <tr>
                                                                <th class="w-3/10 p-1 border">
                                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold" for="grid-state">
                                                                        Test Name
                                                                    </label>
                                                                </th>
                                                                <th class="w-3/10 p-1 border">
                                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold" for="grid-state">
                                                                        Result Unit
                                                                    </label>
                                                                </th>
                                                                <th class="w-3/10 p-1 border">
                                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold" for="grid-state">
                                                                        Reference Ranges
                                                                    </label>
                                                                </th>
                                                                <th class="w-1/10 p-1 border">
                                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold" for="grid-state">
                                                                        Action
                                                                    </label>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(testResult, index) in form.testResults" :key="index">
                                                                <td class="p-1 border">
                                                                    <vue-select
                                                                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"
                                                                        v-model="testResult.medicalTest"
                                                                        :required="true"
                                                                        :key="index"
                                                                        :options="medicalTestList"
                                                                        label-by="name"
                                                                        track-by="id"
                                                                        placeholder="Select Medical Test"
                                                                        close-on-select
                                                                        searchable
                                                                        clear-on-select
                                                                        :disabled="!editable"
                                                                        @update:modelValue="
                                                                        (value) =>
                                                                            (testResult.reference_ranges = value?.reference_ranges)
                                                                        "
                                                                        />
                                                                </td>
                                                                <td class="p-1 border">
                                                                    <textarea
                                                                        v-if="testResult.medicalTest"
                                                                        type="text"
                                                                        v-model="testResult.result"
                                                                        :readonly="!editable"
                                                                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"
                                                                        rows="3"
                                                                        required
                                                                    ></textarea>
                                                                </td>
                                                                <td class="p-1 border">
                                                                    <textarea
                                                                        v-if="testResult.medicalTest"
                                                                        type="text"
                                                                        v-model="testResult.reference_ranges"
                                                                        disabled
                                                                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"
                                                                        rows="3"
                                                                    ></textarea>
                                                                </td>
                                                                <td class="border text-center">
                                                                    <button type="button" @click="form.testResults.splice(index, 1)" v-if="index" class="shadow bg-gray-200 hover:bg-red-300 text-gray-600 font-bold py-2 px-4 rounded-full">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div style="margin: 15px auto;">
                                                    <button @click="addResult" type="button" class="shadow bg-gray-200 hover:bg-gray-300 text-gray-600 font-bold py-2 px-4 rounded-full text-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Add More
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-12/12 px-4">
                                                <div class="relative w-full mb-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" htmlfor="grid-password">
                                                        Comment
                                                    </label>
                                                    <textarea
                                                        type="text"
                                                        v-model="form.comment"
                                                        :readonly="!editable"
                                                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"
                                                        rows="4"
                                                    ></textarea>
                                                    <span
                                                        class="text-red-900"
                                                        v-if="errors"
                                                        >{{ errors.comment }}</span
                                                    >
                                                </div>
                                                <div v-if="editable" class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                                    <button
                                                        class="bg-green-500 text-white active:bg-indigo-600 text-sm font-bold uppercase px-8 py-3 mt-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                        type="submit"
                                                    >
                                                        {{ form.id ? 'Update' : 'Save' }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="deleteId" tabindex="0"
            class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
            <div class="z-50 relative p-3 mx-auto my-0 max-w-full"
                style="width: 500px;">
                <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden px-10 py-10">
                    <div class="text-center py-6 text-2xl text-gray-700">Are you sure ?</div>
                    <div class="text-center font-light text-gray-700 mb-8">
                        Do you really want to delete these records? This process cannot be undone.
                    </div>
                    <div class="flex justify-center">
                        <button @click="deleteId=null"
                            class="bg-gray-300 text-gray-900 rounded hover:bg-gray-200 px-6 py-2 focus:outline-none mx-1">Cancel</button>
                        <button @click="remove()"
                            class="bg-red-500 text-gray-200 rounded hover:bg-red-400 px-6 py-2 focus:outline-none mx-1">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from '@/Components/Pagination';
import { Inertia } from "@inertiajs/inertia";
import VueSelect from "vue-next-select";
import print from 'vue3-print-nb';

export default {
    components: {
        AppLayout,
        Pagination,
        VueSelect
    },
    props: {
        testResultList: Object,
        medicalTestList: Array,
        errors: Object,
        flash: Object,
    },
    directives: {
        print
    },
    mounted() {
    },
    data() {
        return {
            form: this.$inertia.form({
                id: null,
                patient_name: null,
                patient_age: null,
                patient_sex: null,
                refd_by: null,
                specimen: null,
                testResults: [{
                    medicalTest: null,
                    result: null,
                }],
                comment: null

            }),
            editable: true,
            message: '',
            error: '',
            deleteId: null,
        };
    },
    methods: {
        create() {
            this.editable = true;
            this.form.reset();
        },
        edit(medicalTest) {
            this.editable = true;
            this.form = {...this.form, ...medicalTest};
        },
        show(medicalTest) {
            this.editable = false;
            this.form = {...this.form, ...medicalTest};
        },
        submit() {
            if (this.form.id) {
                Inertia.put(route("test-results.update", this.form.id), this.form);
            } else {
                Inertia.post(route("test-results.store"), this.form);
            }
        },
        remove() {
            Inertia.delete(route("test-results.destroy", this.deleteId));
            this.deleteId = null;
        },
        changeMedicalTest(test){
            console.log(test);
        },
        addResult: function () {
        this.form.testResults.push({
            medicalTest: null,
            result: null,
         });
        }
    },
    watch: {
        flash: {
            handler: function () {
                if (this.flash.success) {
                    this.form.reset();
                    this.message = this.flash.message ?? "Saved successfully";
                    setTimeout(() => this.message = '', 4000)
                }else{
                    this.message = '';
                    this.error = this.flash.message;
                    setTimeout(() => this.error = '', 10000)
                }
            },
            deep: true,
        },
    },
};
</script>
