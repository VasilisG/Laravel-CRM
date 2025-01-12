<x-layout title="Dashboard">
  <div class="dashboard-inner-container">
    <div class="stats-container flex gap-3">
      <x-stats title="Clients" resource="clients" :data="$clients"></x-stats>
      <x-stats title="Projects" resource="projects" :data="$projects"></x-stats>
      <x-stats title="Tasks" resource="tasks" :data="$tasks"></x-stats>
    </div>
    <div class="projects-at-risk-container mt-4">
      <x-risk-entity title="Projects at risk" resource="project" :data="$projects_at_risk"></x-risk-projects>
    </div>
    <div class="tasks-at-risk-container mt-4">
      <x-risk-entity title="Tasks at risk" resource="tasks" :data="$tasks_at_risk"></x-risk-projects>
    </div>
  </div>
</x-layout>