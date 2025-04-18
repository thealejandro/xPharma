import { Head } from '@inertiajs/react'
import { PageProps } from '@/types/global'
import AppLayout from '@/layouts/app-layout'
import { Card } from '@/components/ui/card'

export default function PurchasesIndex({ auth }: PageProps) {
  return (
    <AppLayout user={auth.user} header={<h1 className="text-2xl font-bold">Purchases</h1>}>
      <Head title="Purchases" />

      <div className="p-4 sm:p-6 lg:p-8">
        <Card className="p-4 text-gray-500 dark:text-gray-300">
          Aquí se listarán las compras realizadas.
        </Card>
      </div>
    </AppLayout>
  )
}
