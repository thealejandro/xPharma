import type { route as routeFn } from 'ziggy-js';

declare global {
    const route: typeof routeFn;
}

export interface PageProps {
    auth: {
      user: {
        id: number
        name: string
        email: string
        // cualquier otro campo que recibas en el objeto user
      }
    }
  }
