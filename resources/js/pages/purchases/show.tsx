import { Head, useForm } from '@inertiajs/react'
import { Card, CardContent } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { router } from '@inertiajs/react'

export default function CreatePurchase() {
  const { data, setData, post, processing, errors } = useForm({
    proveedor: '',
    fecha: new Date().toISOString().slice(0, 10),
    productos: [], // productos a agregar a la compra
  })

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    post('/purchases')
  }

  return (
    <>
      <Head title="New Purchase" />
      <div className="space-y-4">
        <h2 className="text-2xl font-bold">Register New Purchase</h2>

        <Card>
          <CardContent className="p-6">
            <form onSubmit={handleSubmit} className="space-y-4">
              <div>
                <Label htmlFor="proveedor">Supplier</Label>
                <Input
                  id="proveedor"
                  value={data.proveedor}
                  onChange={e => setData('proveedor', e.target.value)}
                  className={errors.proveedor ? 'border-red-500' : ''}
                />
                {errors.proveedor && (
                  <p className="text-red-500 text-sm">{errors.proveedor}</p>
                )}
              </div>

              <div>
                <Label htmlFor="fecha">Date</Label>
                <Input
                  id="fecha"
                  type="date"
                  value={data.fecha}
                  onChange={e => setData('fecha', e.target.value)}
                />
              </div>

              {/* Aquí se agregaría un componente dinámico para elegir productos y cantidades */}

              <Button type="submit" disabled={processing}>
                Save Purchase
              </Button>
            </form>
          </CardContent>
        </Card>
      </div>
    </>
  )
}
