//@ts-check

export interface apiResult {
  status: number
  data: Record<string, unknown>
  errorMessage: string | null
}
