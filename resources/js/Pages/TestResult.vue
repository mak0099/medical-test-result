<template>
    <app-layout title="Medical Test">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                            <div class="rounded-t mb-0 px-4 py-3 border-0">
                                <div class="flex flex-wrap items-center">
                                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                        <h3 class="font-semibold text-base text-blueGray-700">Test Result List <small>({{testResultList.total}})</small></h3>
                                    </div>
                                    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                        <Link
                                            class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            type="button"
                                            :href="route('test-results.create')"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                                New Test Result
                                        </Link>
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
                                                Invoice No
                                            </th>
                                            <th
                                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            >
                                                Patient Name
                                            </th>
                                            <th
                                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            >
                                                Patient Age
                                            </th>
                                            <th
                                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            >
                                                Patient Sex
                                            </th>
                                            <th
                                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            >
                                                Specimen
                                            </th>
                                            <th
                                                class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            >
                                                Action
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(testResult, index) in testResultList.data" :key="index">
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
                                                {{
                                                    index +
                                                    1 +
                                                    testResultList.per_page *
                                                        (testResultList.current_page - 1)
                                                }}
                                            </td>
                                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
                                                <Link :href="route('test-results.show', testResult)" title="Click to preview">
                                                    {{testResult.invoice_no}}
                                                </Link>
                                            </th>
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                <pre>{{testResult.patient_name}}</pre>
                                            </td>
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                <pre>{{testResult.patient_age}}</pre>
                                            </td>
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                <pre>{{testResult.patient_sex}}</pre>
                                            </td>
                                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                <pre>{{testResult.specimen}}</pre>
                                            </td>
                                            <td class="justify-center border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                <button
                                                    title="Delete"
                                                    class="bg-red-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                    type="button"
                                                    @click="deleteId = testResult.id"
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
                                <pagination class="mt-6" :links="testResultList.links" />
                            </div>
                        </div>
                    </section>
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
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Pagination,
        Link
    },
    props: {
        testResultList: Object,
        errors: Object,
        flash: Object,
    },
    data() {
        return {
            message: '',
            deleteId: null
        };
    },
    methods: {
        remove() {
            Inertia.delete(route("test-results.destroy", this.deleteId));
            this.deleteId = null;
        },
    },
    watch: {
        flash: {
            handler: function () {
                if (this.flash.success) {
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
