<div>
    <x-slot name="header">Tenant List</x-slot>

    <x-Ui::forms.m-panel>

        <x-Ui::alerts.notification/>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-Ui::forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Caption -------------------------------------------------------------------------------------------->
        <x-Ui::table.caption :caption="'Tenants'">
            {{$list->count()}}
        </x-Ui::table.caption>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-Ui::table.form>
            <x-slot:table_header>
                <x-Ui::table.header-serial/>
                <x-Ui::table.header-text wire:click.prevent="sortBy('id')" sortIcon="{{$sortAsc}}" :left="true">
                    Name
                </x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Tenant Name</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Contact</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Phone</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Software</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Database</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Migration Status</x-Ui::table.header-text>

                <x-Ui::table.header-status/>
                <x-Ui::table.header-action/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)
                    <x-Ui::table.row>
                        <x-Ui::table.cell-text>{{$index+1}}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text left>{{$row->b_name}}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text left>{{$row->t_name}}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text left>{{$row->contact}}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text left>{{$row->phone}}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text left>
                            {{\Aaran\Assets\Enums\Software::tryFrom($row->software_id)->getName()}}
                        </x-Ui::table.cell-text>
                        <x-Ui::table.cell-text left>{{$row->db_name}}</x-Ui::table.cell-text>

                        <x-Ui::table.cell-link :href="route('tenant-migrations',$row->id)">
                            {{$row->migration_status}}
                        </x-Ui::table.cell-link>
                        <x-Ui::table.cell-status active="{{$row->active_id}}"/>
                        <x-Ui::table.cell-action id="{{$row->id}}"/>
                    </x-Ui::table.row>
                @endforeach
            </x-slot:table_body>
        </x-Ui::table.form>

        <!-- Delete Modal --------------------------------------------------------------------------------------------->
        <x-Ui::modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->

        <x-Ui::forms.create-tab :id="$vid" :max-width="'6xl'">
            <div class="h-full">
                <!-- Tab Header --------------------------------------------------------------------------------------->
                <x-Ui::tabs.tab-panel>

                    <x-slot name="tabs">
                        <x-Ui::tabs.tab>Mandatory</x-Ui::tabs.tab>
                        <x-Ui::tabs.tab>Database</x-Ui::tabs.tab>
                        <x-Ui::tabs.tab>Software</x-Ui::tabs.tab>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Tab 1 ------------------------------------------------------------------------------------>

                        <x-Ui::tabs.content>
                            <div class="flex flex-col  gap-3">

                                <div>
                                    <x-Ui::input.floating autofocus wire:model="b_name" label="Business Name"/>
                                    <x-Ui::input.error-text wire:model="b_name"/>
                                </div>

                                <div>
                                    <x-Ui::input.floating wire:model="t_name" label="Tenant Name"/>
                                    <x-Ui::input.error-text wire:model="t_name"/>
                                </div>

                                <div>
                                    <x-Ui::input.floating wire:model="email" label="Email"/>
                                    <x-Ui::input.error-text wire:model="email"/>
                                </div>

                                <div>
                                    <x-Ui::input.floating wire:model="contact" label="Contact Name"/>
                                    <x-Ui::input.error-text wire:model="contact"/>
                                </div>

                                <div>
                                    <x-Ui::input.floating wire:model="phone" label="Phone"/>
                                    <x-Ui::input.error-text wire:model="phone"/>
                                </div>

                            </div>
                        </x-Ui::tabs.content>

                        <!-- Tab 2 ------------------------------------------------------------------------------------>

                        <x-Ui::tabs.content>
                            <div class="flex flex-col  gap-3">

                                <div>
                                    <x-Ui::input.floating wire:model="db_name" label="Database Name"/>
                                    <x-Ui::input.error-text wire:model="db_name"/>
                                </div>

                                <div>
                                    <x-Ui::input.floating wire:model="db_user" label="DB Username"/>
                                    <x-Ui::input.error-text wire:model="db_user"/>
                                </div>

                                <div>
                                    <x-Ui::input.floating wire:model="db_pass" label="DB Pass"/>
                                    <x-Ui::input.error-text wire:model="db_pass"/>
                                </div>
                            </div>
                        </x-Ui::tabs.content>

                        <!-- Tab 2 ------------------------------------------------------------------------------------>

                        <x-Ui::tabs.content>

                            <div>
                                <x-Ui::input.floating-dropdown
                                    wire:model="software_id"
                                    label="software"
                                    id="software_id"
                                    :options="$software"
                                    placeholder=""
                                />
                                <x-Ui::input.error-text wire:model="software_id"/>
                            </div>

                            <div class="mt-5">
                                <x-Ui::input.rich-text wire:model="remarks" label="Remarks"/>
                            </div>
                        </x-Ui::tabs.content>

                    </x-slot>
                </x-Ui::tabs.tab-panel>
            </div>
        </x-Ui::forms.create-tab>

    </x-Ui::forms.m-panel>
</div>
