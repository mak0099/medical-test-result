<template>
    <app-layout title="Test Report">
        <div class="py-6 grid lg:grid-cols-6 lg:gap-4">
            <div class="col-start-2 col-span-4 relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-blueGray-700">
                                Preview Test Result
                            </h3>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="block w-full overflow-x-auto p-6">
                    <div class="w-full px-4 max-w-full flex-grow flex-1 text-left">
                        <Link
                            class="bg-gray-100 text-gray-600 hover:bg-gray-200 shadow text-xs font-bold uppercase px-6 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                            :href="route('test-results.create')"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                            Create new
                        </Link>
                        <Link
                            class="bg-gray-100 text-gray-600 hover:bg-gray-200 shadow text-xs font-bold uppercase px-6 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                            :href="route('test-results.index')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Test Result List
                        </Link>
                    </div>
                    <div class="w-full px-4 max-w-full flex-grow flex-1 text-right">
                        <button
                            v-print="'#printMe'"
                            class="bg-green-500 text-white hover:bg-green-600 text-xs font-bold uppercase px-6 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print
                        </button>
                    </div>
                    <div id="printMe" class="px-10 relative" style="min-height: 25cm">
                        <div style="height: 3cm"></div>
                        <div class="border border-gray-500 p-4">
                            <table class="w-full table-auto">
                                <tr>
                                    <th class="text-left">ID No </th>
                                    <td>: {{testResult.invoice_no}}</td>
                                    <th></th>
                                    <td></td>
                                    <th class="text-left">Received Date </th>
                                    <td>: {{testResult.date}}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Pt. Name </th>
                                    <td>: {{testResult.patient_name}}</td>
                                    <th></th>
                                    <td></td>
                                    <th class="text-left">Delivery Date </th>
                                    <td>: {{testResult.date}}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Age </th>
                                    <td>: {{testResult.patient_age}}Y 00M 00D</td>
                                    <th class="text-left">Sex </th>
                                    <td>: {{testResult.patient_sex}}</td>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Refd. By. </th>
                                    <td>: {{testResult.refd_by}}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Specimen </th>
                                    <td>: {{testResult.specimen}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="py-4">
                            <h1 class="underline text-center text-xl">BIO CHEMISTRY REPORT</h1>
                            <h3 class="underline text-center">ESTIMATIONS ARE CARRIED OUT BY LABOMED.INC.BAS-150TS</h3>
                            <h3 class="underline text-center">AUTO ANALYZER</h3>
                        </div>
                        <div class="p-4">
                            <table class="w-full table-auto">
                                <tr>
                                    <th class="underline">TEST NAME</th>
                                    <th class="underline">RESULT UNIT</th>
                                    <th class="underline">REFERENCE RANGES</th>
                                </tr>
                                <tr v-for="(item, index) in testResult.test_result_items" :key="index">
                                    <td class="text-center">{{item.test_name}}</td>
                                    <td class="text-center"><pre>{{item.result}}</pre></td>
                                    <td class="text-center"><pre>{{item.reference_ranges}}</pre></td>
                                </tr>
                            </table>
                        </div>
                        <div class="absolute left-0 right-0" style="bottom: 3cm">
                            <div class="flex justify-around items-end">
                                <div>
                                    <h3 class="font-bold">Sufiya Akhter</h3>
                                    <p class="text-sm font-semibold">Diploma In Laboratory Medicine (LAB)</p>
                                </div>
                                <div>
                                    <h3 class="font-bold">Dr. Sujan Sarker</h3>
                                    <p class="text-sm font-semibold">MBBS, DLM, CCD</p>
                                    <p class="text-sm font-semibold">CONSALTANT</p>
                                    <p class="text-sm font-semibold">BASHUNDHARA AD-DIN MEDICAL COLLEGE H.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import print from 'vue3-print-nb';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Link
    },
    props: {
        testResult: Object,
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
            message: '',
        };
    },
    methods: {

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
