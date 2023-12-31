export default {
    data() {
        return {
            startDate: null,
            endDate: null
        }
    },
    watch: {
        startDate(newStartDate, oldStartDate) {
            if (newStartDate !== oldStartDate) {
                this.$emit('date-changed', { startDate: this.startDate, endDate: this.endDate });
            }
        },
        endDate(newEndDate, oldEndDate) {
            if (newEndDate !== oldEndDate) {
                this.$emit('date-changed', { startDate: this.startDate, endDate: this.endDate });
            }
        }
    },
    template: `
        <div date-rangepicker class="flex items-center">
        <span class="mx-4 text-gray-500">Select departure from</span>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            </div>
            <input v-model="startDate" name="start" type="date" class="bg-gray-50 block border border-gray-300 focus:border-blue-500 focus:ring-blue-500 p-2.5 pl-10 rounded-lg text-gray-900 text-sm w-full">
        </div>
        <span class="mx-4 text-gray-500">to</span>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            </div>
            <input v-model="endDate" name="end" type="date" class="bg-gray-50 block border border-gray-300 focus:border-blue-500 focus:ring-blue-500 p-2.5 pl-10 rounded-lg text-gray-900 text-sm w-full">
        </div>
        </div>
    `
}
