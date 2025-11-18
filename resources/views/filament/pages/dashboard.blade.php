<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Quick Actions Section --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <x-filament::card class="hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 p-3 bg-success-500/10 rounded-lg">
                        <x-heroicon-o-calendar class="w-8 h-8 text-success-500" />
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Quick Action</h3>
                        <a href="{{ route('filament.admin.resources.appointments.create') }}" class="text-lg font-semibold text-primary-600 dark:text-primary-400 hover:underline">
                            New Appointment
                        </a>
                    </div>
                </div>
            </x-filament::card>

            <x-filament::card class="hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 p-3 bg-info-500/10 rounded-lg">
                        <x-heroicon-o-user-group class="w-8 h-8 text-info-500" />
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Quick Action</h3>
                        <a href="{{ route('filament.admin.resources.therapists.index') }}" class="text-lg font-semibold text-primary-600 dark:text-primary-400 hover:underline">
                            Manage Therapists
                        </a>
                    </div>
                </div>
            </x-filament::card>

            <x-filament::card class="hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 p-3 bg-warning-500/10 rounded-lg">
                        <x-heroicon-o-rectangle-stack class="w-8 h-8 text-warning-500" />
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Quick Action</h3>
                        <a href="{{ route('filament.admin.resources.services.index') }}" class="text-lg font-semibold text-primary-600 dark:text-primary-400 hover:underline">
                            View Services
                        </a>
                    </div>
                </div>
            </x-filament::card>

            <x-filament::card class="hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 p-3 bg-danger-500/10 rounded-lg">
                        <x-heroicon-o-envelope class="w-8 h-8 text-danger-500" />
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Quick Action</h3>
                        <a href="{{ route('filament.admin.resources.appointments.index') }}?tableFilters[status][value]=pending" class="text-lg font-semibold text-primary-600 dark:text-primary-400 hover:underline">
                            Pending Appointments
                        </a>
                    </div>
                </div>
            </x-filament::card>
        </div>

        {{-- Widgets Section --}}
        <x-filament-widgets::widgets
            :widgets="$this->getVisibleWidgets()"
            :columns="$this->getColumns()"
        />
    </div>
</x-filament-panels::page>
