import SVGButton from './SvgButton.js';

export default {
    components: { SVGButton },
    props: ['columns'],
    template: `
        <thead>
            <tr>
                <th v-for="(column, index) in columns" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    {{ column }}
                    <SVGButton v-if="index === 4" @sort-flights="$emit('sort-flights', $event)" />
                </th>
            </tr>
        </thead>
    `
}