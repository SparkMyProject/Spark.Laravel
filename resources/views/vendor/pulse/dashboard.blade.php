<x-pulse>
  <livewire:pulse.servers cols="full"/>

  <livewire:database cols='6' title="Active threads" :values="['Threads_connected', 'Threads_running']" :graphs="[
    'avg' => ['Threads_connected' => '#ffffff', 'Threads_running' => '#3c5dff'],]"/>

  <livewire:database cols='6' title="Connections" :values="['Connections', 'Max_used_connections']"/>

  <livewire:pulse.usage cols="4" rows="2"/>

  <livewire:pulse.queues cols="4"/>

  <livewire:pulse.cache cols="4"/>

  <livewire:pulse.slow-queries cols="8"/>

  <livewire:pulse.exceptions cols="6"/>

  <livewire:pulse.slow-requests cols="6"/>

  <livewire:pulse.slow-jobs cols="6"/>

  <livewire:pulse.slow-outgoing-requests cols="6"/>

  <livewire:pulse.validation-errors cols="8" rows="4"/>


</x-pulse>
