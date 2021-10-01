<template>
    <app-layout title="Medical Test">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <div class="p-6 col-span-2">
                                <section class="py-1 bg-blueGray-50">
                                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                                        <div class="p-2 float-right" v-if="message">
                                            <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded relative" role="alert">
                                                <span class="block sm:inline">{{message}}</span>
                                                <span class="absolute top-0 bottom-0 right-0 px-3 py-2" @click="message=''">
                                                    <svg class="fill-current h-3 w-3 text-green-500" role="button" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                                            <div class="flex flex-wrap items-center">
                                                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                                    <h3 class="font-semibold text-base text-blueGray-700">Medical Tests <small>({{medicalTestList.total}})</small></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="block w-full overflow-x-auto">
                                            <table class="items-center bg-transparent w-full border-collapse">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                        >
                                                            #
                                                        </th>
                                                        <th
                                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                        >
                                                            Test Name
                                                        </th>
                                                        <th
                                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                        >
                                                            Reference Ranges
                                                        </th>
                                                        <th
                                                            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                        >
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr v-for="(medicalTest, index) in medicalTestList.data" :key="index" :class="{'bg-gray-600 bg-opacity-10' : medicalTest.id == form.id}">
                                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
                                                            {{
                                                                index +
                                                                1 +
                                                                medicalTestList.per_page *
                                                                    (medicalTestList.current_page - 1)
                                                            }}
                                                        </td>
                                                        <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
                                                            {{medicalTest.name}}
                                                        </th>
                                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                            <pre>{{medicalTest.reference_ranges}}</pre>
                                                        </td>
                                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                            <button
                                                                title="View"
                                                                class="bg-purple-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                                type="button"
                                                                @click="show(medicalTest)"
                                                            >
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                title="Edit"
                                                                class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                                type="button"
                                                                @click="edit(medicalTest)"
                                                            >
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            </button>
                                                            <button
                                                                title="Delete"
                                                                class="bg-red-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                                type="button"
                                                                @click="deleteId = medicalTest.id"
                                                            >
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="p-2">
                                            <pagination class="mt-6" :links="medicalTestList.links" />
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="p-6">
                                <section class="py-1 bg-blueGray-50">
                                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                                            <div class="flex flex-wrap items-center">
                                                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                                    <h3 v-if="editable" class="font-semibold text-base text-blueGray-700">
                                                        {{
                                                            form.id
                                                                ? "Edit Test"
                                                                : "New Test"
                                                        }}
                                                    </h3>
                                                    <h3 v-else class="font-semibold text-base text-blueGray-700">
                                                         Test Details
                                                    </h3>
                                                </div>
                                                <div v-if="form.id" class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                                    <button
                                                        class="bg-indigo-500 text-white active:bg-indigo-600 shadow text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                        type="button"
                                                        @click="create()"
                                                    >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="block w-full overflow-x-auto p-4">
                                            <form @submit.prevent="submit">
                                                <div class="w-full lg:w-12/12 px-4">
                                                    <div class="relative w-full mb-3">
                                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                                            Test Name
                                                        </label>
                                                        <input
                                                            type="text"
                                                            v-model="form.name"
                                                            :readonly="!editable"
                                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                        />
                                                        <span
                                                            class="text-red-500"
                                                            v-if="errors"
                                                            >{{ errors.name }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="w-full lg:w-12/12 px-4">
                                                    <div class="relative w-full mb-3">
                                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                                                            Reference Ranges
                                                        </label>
                                                        <textarea
                                                            type="text"
                                                            v-model="form.reference_ranges"
                                                            :readonly="!editable"
                                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                            rows="4"
                                                        ></textarea>
                                                        <span
                                                            class="text-red-900"
                                                            v-if="errors"
                                                            >{{ errors.reference_ranges }}</span
                                                        >
                                                    </div>
                                                    <div v-if="editable" class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                                        <button
                                                            class="bg-green-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-6 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
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
        <div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50"></div>
    </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from '@/Components/Pagination';
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        AppLayout,
        Pagination
    },
    props: {
        medicalTestList: Object,
        errors: Object,
        flash: Object,
    },
    mounted() {
    },
    data() {
        return {
            form: this.$inertia.form({
                id: null,
                name: null,
                reference_ranges: null,
            }),
            editable: true,
            message: '',
            deleteId: null
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
                Inertia.put(route("medical-tests.update", this.form.id), this.form);
            } else {
                Inertia.post(route("medical-tests.store"), this.form);
            }
        },
        remove() {
            Inertia.delete(route("medical-tests.destroy", this.deleteId));
            this.deleteId = null;
        },
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
                }
            },
            deep: true,
        },
    },
};
</script>
