<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-calendar class="w-5 h-5" />
                Upcoming Appointments (Next 14 Days)
            </div>
        </x-slot>

        <div class="space-y-4">
            @forelse($this->getUpcomingAppointments() as $date => $appointments)
                <div class="border-l-4 border-primary-500 pl-4 py-2 bg-gray-50 dark:bg-gray-800 rounded-r-lg">
                    <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-gray-100">
                        {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                    </h3>

                    <div class="space-y-2">
                        @foreach($appointments as $appointment)
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-900 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center space-x-4 flex-1">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                                            <x-heroicon-o-clock class="w-6 h-6 text-primary-600 dark:text-primary-400" />
                                        </div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                {{ $appointment->name }}
                                            </p>
                                            @if($appointment->status)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                    {{ $appointment->status === 'confirmed' ? 'bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200' : '' }}
                                                    {{ $appointment->status === 'pending' ? 'bg-warning-100 text-warning-800 dark:bg-warning-900 dark:text-warning-200' : '' }}
                                                    {{ $appointment->status === 'cancelled' ? 'bg-danger-100 text-danger-800 dark:bg-danger-900 dark:text-danger-200' : '' }}
                                                ">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-4 mt-1">
                                            <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                <x-heroicon-o-clock class="w-4 h-4" />
                                                {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('g:i A') }}
                                            </p>

                                            @if($appointment->therapist)
                                                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                    <x-heroicon-o-user class="w-4 h-4" />
                                                    {{ $appointment->therapist->name }}
                                                </p>
                                            @endif

                                            @if($appointment->service)
                                                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                                    <x-heroicon-o-wrench-screwdriver class="w-4 h-4" />
                                                    {{ $appointment->service->title }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-shrink-0 ml-4">
                                    <a href="{{ route('filament.admin.resources.appointments.view', $appointment) }}"
                                       class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200">
                                        View
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <x-heroicon-o-calendar class="mx-auto h-12 w-12 text-gray-400" />
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No upcoming appointments</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No appointments scheduled for the next 14 days.</p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
