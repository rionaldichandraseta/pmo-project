<template>
    <div>
        <vue-good-table
                :title="tableTitle"
                :columns="columns"
                :rows="rows"
                :paginate="true"
                :lineNumbers="true"
                :searchOptions="{
                    enabled: true,
                    placeholder: 'Cari data',
                    externalQuery: searchQuery
                }"
                :paginationOptions="{
                    enabled: true,
                    perPage: 8
                }"
                styleClass="vgt-table striped condensed bordered text-nowrap">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'editButton'">
                    <button class="btn btn-sm btn-default"
                            v-if="props.row.originalIndex != rowBeingEdited"
                            :disabled="rowBeingEdited != -1"
                            @click="editRow(props)">
                        Edit
                    </button>
                    <button class="btn btn-sm btn-primary"
                            v-else
                            @click="saveRow(props)">
                        Save
                    </button>
                </span>
                <span v-else-if="props.column.field == 'viewButton'">
                    <a class="btn btn-sm btn-default"
                        :href="props.column.href + '/' +  props.row['id_user']"
                       @click="viewProfile(props)">
                        View
                    </a>
                </span>
                <span v-else-if="props.column.field == 'deleteButton'">
                    <button class="btn btn-sm btn-danger"
                            data-toggle="modal"
                            data-target="#deleteConfirmationModal"
                            @click="prepareDeleteRow(props)">
                        Delete
                    </button>
                </span>
                <span v-else-if="props.row.originalIndex == rowBeingEdited && !props.column.immutable">
                    <input class="form-control"
                           :id="props.column.field + '-' + props.row.originalIndex"
                           :title="props.column.label"
                           :type="props.column.type == 'number' || 'date' ? props.column.type : 'text'"
                           v-model="dataBeingEdited[props.column.field]"/>
                </span>
                <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template>
        </vue-good-table>
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert">
                            Apakah anda yakin ingin menghapus entri tersebut?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="deleteRow">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'data-table',
        props: [
            'tableTitle',
            'columns',
            'rows',
            'searchQuery'
        ],
        data(){
            return {
                rowBeingEdited: -1,
                dataBeingEdited: {},
                rowBeingDeleted: -1
            };
        },
        methods: {
            editRow(props) {
                this.rowBeingEdited = props.row.originalIndex;
                this.dataBeingEdited = props.row;
            },
            saveRow(props) {
                this.$emit('dataChange', this.dataBeingEdited);
                this.rowBeingEdited = -1;
                this.dataBeingEdited = {};
            },
            viewProfile(props) {
                console.log(props);
            },
            prepareDeleteRow(props) {
                this.rowBeingDeleted = props.row;
            },
            deleteRow() {
                this.$emit('dataDelete', this.rowBeingDeleted);
            }
        }
    };
</script>